<?php
/**
 * Mediasharex Nested Set Model Manager
 *
 */
class Mediasharex_Util_AlbumTree {

    /*Properties*/

    /**
     * @var object
     */
    protected $tables;

    /**
     * Name of the database table
     * @var string
     */
    protected $table = '';

    /**
     * Name of the database table
     * @var string
     */
    protected $column;

    /**
     * Primary key field of the database table
     * @var string
     */
    public $idfield = 'id';
    
    /**
     * Parent id field of the database table
     * @var string
     */
    public $parentidfield = 'parent_id';

    /**
     * Left field of the nested
     *  @var string
     */
    public $lftfield = 'lft';
    
    /**
     * Right field of the nested
     *  @var string
     */
    public $rgtfield = "rgt";
    
    /**
     * Level field of the nested
     *  @var string
     */
    public $levelfield = "level";

    /**
     * Namefield in the database table
     * @var unknown_type
     */
    public $namefield = 'title';
    

    
    /**
    * Stores a jDb object for further use
    * @param string $tablename nom de la table
    * @return boolean true
    
    public function __construct($tablename) {
           $this->db = jDb::getConnection();
           $this->table = $tablename;
           return true;
    }
	*/
	public function	__construct()
	{

	    $this->tables 			= DBUtil::getTables();
	    $this->table 			= 'mediasharex_albums';
		$this->column			= $this->tables['mediasharex_albums_column'];
		$this->idfield 			= $this->column['id'];
		$this->namefield 		= $this->column['title'];		
		$this->parentidfield 	= $this->column['parentalbum'];
		$this->lftfield 		= $this->column['nestedsetleft'];
		$this->rgtfield 		= $this->column['nestedsetright'];
		$this->levelfield 		= $this->column['nestedsetlevel'];
				
	}
	
    /**
    * A utility function to return an array of the fields
    * that need to be selected in SQL select queries
    *
    * @return  array   An indexed array of fields to select
    */
    protected function _getFields()
    {
    	return  array_values($this->column);
		
       //return array($this->namefield, $this->idfield, $this->parentidfield, $this->lftfield, $this->rgtfield, $this->levelfield);
    }
    
    
    /**
     * Creates a new node
     * @access private
     * @param string $name name of the new node
     * @param integer $lft lft of parent node
     * @param integer $rgt rgt of parent node
     * @return last insert id
     */
    private function insertNode($name, $parent_id, $level, $rgt) {
 
 		
		//lock table
		
		
        $sql = "UPDATE " . $this->table . " SET $this->rgtfield = $this->rgtfield + 2 WHERE $this->rgtfield >= " . $rgt . ";";      
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
		               
        $sql = "UPDATE " . $this->table . " SET $this->lftfield = $this->lftfield + 2 WHERE $this->lftfield > " . $rgt . ";";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        } 
		
		
		$new_node = array($this->namefield 		=> $name,
						  $this->parentidfield	=> $parent_id,
						  $this->levelfield		=> $level+1,
						  $this->lftfield		=> $rgt,
						  $this->rgtfield		=> $rgt+1,
						  );
		
        //$sql = "INSERT INTO " . $this->table . " ($this->namefield , $this->parentidfield, $this->levelfield, $this->lftfield, $this->rgtfield) VALUES (".$name.",$parent_id,$level+1,$rgt,);";
        $result = DBUtil::insertObject($new_node,$this->table);
        if ($result === false) {
		return null;
        } 
		
		
        return $result;
    }
    
    
    /**
    * Creates a root node
    * @param string $name Name of the new node
    * @return int The id of the created root
    */
    public function createRootNode($name) {
		
		$new_node = array($this->namefield 		=> $name,
						  $this->parentidfield	=> 0,
						  $this->levelfield		=> 0,
						  $this->lftfield		=> 1,
						  $this->rgtfield		=> 2,
						  );
		
        $result = DBUtil::insertObject($new_node,$this->table);
        if ($result === false) {
		return null;
        } 
        return $result;		

    }
     
    
    /**
    * Get all root nodes
    * 
    * @return array All the root nodes
    */
    public function getAllRoots() {
        $where = "WHERE $this->parentidfield = 0;";
        return DBUtil::selectObject($this->table,$where);
    }
    
    
    /**
     * Creates a new child node of the node with the given id
     * @param string $name name of the new node
     * @param integer $parent id of the parent node
     * @return int lastinsertid
     */
    public function insertChildNode($name, $parent_id) {
        //$this->db->beginTransaction();
		
        $p_node = $this->getNode($parent_id);    
        $lastinsertid = $this->insertNode($name, $parent_id, $p_node[$this->levelfield], $p_node[$this->rgtfield]);
        
        //$this->db->commit();
        return $lastinsertid;
    }
    
    /**
    * Fetch the node data for the node identified by $id
    *
    * @param   int     $id     The ID of the node to fetch
    * @return  object          An object containing the node'
    *                          data or null if node not found
    */
    
    public function getNode($id) {
    	
        if($id)
        {
        return DBUtil::selectObjectByID($this->table,$id);							
        }
        else
        {
        return null;
        }
    }
    
     /**
    * Fetch the node data for the node identified by $id
    * and calculate her level (should be the same as the level field)
    * The calculate level is returned as "level_find"
    * Might be useful if we're working with a nested table without level field
    *
    * @param   int     $id     The ID of the node to fetch
    * @return  object          An object containing the node's
    *                          data, or null if node not found
    */
    
    public function getNodeAndFindLevel($id) {
        $sql = "SELECT parent.*, COUNT(*) AS level_find FROM $this->table as node, $this->table as parent
                    WHERE node.$this->lftfield < parent.$this->lftfield
                    AND node.$this->rgtfield > parent.$this->rgtfield
                    AND parent.$this->idfield = $id";
					
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
		
		$fields_arr = $this->_getFields();
		$fields_arr[] = 'level_find';        
        return  DBUtil::marshallObjects($result, $fields_arr);	
    }
    
    
    /**
    * Fetch the descendants of a node.
    * Optionally, only return child data instead of all descendant data.
    *
    * @param   int     $id             The ID of the node to fetch descendant data for.
    * @param   int     $root_id        The ID of the root of the tree, important in multiroot table
    * @param   bool    $includeSelf    Whether or not to include the passed node in the
    *                                  the results.
    * @param   bool    $childrenOnly   True if only returning children data. False if
    *                                  returning all descendant data
    * @return  array                   The descendants of the passed now
    */
    public function getDescendants($id = 0, $includeSelf = false, $childrenOnly = false){
        $compare = ($includeSelf == true)?'>=':'>';
        if(!$childrenOnly){
            $sql = "SELECT node.* 
                FROM $this->table AS node, $this->table AS parent 
                WHERE node.$this->lftfield $compare parent.$this->lftfield AND node.$this->lftfield < parent.$this->rgtfield 
                AND parent.$this->idfield = $id
                GROUP BY node.$this->lftfield
                ORDER BY node.$this->lftfield
                ;";
											
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }       
        return  DBUtil::marshallObjects($result, $this->_getFields());	
        }
		
        else{
            $sql="SELECT node.* 
                FROM $this->table AS node, $this->table AS parent 
                WHERE node.$this->lftfield $compare parent.$this->lftfield AND node.$this->lftfield < parent.$this->rgtfield
                AND node.$this->levelfield $compare parent.$this->levelfield
                AND node.$this->levelfield < parent.$this->levelfield + 2
                AND parent.$this->idfield = $id
                GROUP BY node.$this->lftfield
                ORDER BY node.$this->lftfield
                ;";
                
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }        
        return  DBUtil::marshallObjects($result, $this->_getFields());
        }       
    }
    
    
    /**
    * Fetch the children of a node
    *
    * @param   int     $id             The ID of the node to fetch child data for.
    * @param   bool    $includeSelf    Whether or not to include the passed node in the
    *                                  the results.
    * @return  array                   The children of the passed node
    */
    public function getChildren($id = 0, $includeSelf = false)
    {
        return $this->getDescendants($id, $includeSelf, true);
    }
    
    
    /**
     * Gets a multidimensional array containing the path to defined node
     *
     * @param integer $id id of the node to which the path should point
     *
     * @return array multidimensional array with the data of the nodes in the tree
     */
    public function getPath($id) {
        $sql = "SELECT parent.$this->idfield, parent.$this->namefield , parent.$this->levelfield FROM $this->table node, $this->table parent 
                WHERE node.$this->idfield = $id
                AND node.$this->lftfield BETWEEN parent.$this->lftfield AND parent.$this->rgtfield 
                ORDER BY parent.$this->lftfield";

        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        return  DBUtil::marshallObjects($result, array('id','title','nestedsetlevel'));		
  
    }
    
    
    /**
    * Gets a node depending on it's rgt value and it's root_id
    * Return false if there is no node with this rgt value
    * @param integer $rgt rgt value of the node
    * @return object of the node
    */
    protected function getNodeByRgt($rgt) {
        $query = sprintf('SELECT %s FROM %s WHERE %s = %d', join(',', $this->_getFields()),
                                                    $this->table,
                                                    $this->rgtfield,$rgt);
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        return  DBUtil::marshallObjects($result, $this->_getFields());
    }
    
    
    /**
    * Gets a node depending on it's lft value and it's root_id
    * Return false if there is no node with this lft value
    * @param integer $lft lft value of the node
    * @return object of the node
    */
    protected function getNodeByLft($lft) {
        $query = sprintf('SELECT %s FROM %s WHERE %s = %d', join(',', $this->_getFields()),
                                                    $this->table,
                                                    $this->lftfield,$lft);
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        return  DBUtil::marshallObjects($result, $this->_getFields());
    }
    
    
    /**
    * Check if one node descends from another node. If either node is not
    * found, then false is returned.
    *
    * @param   int     $descendant_id  The node that potentially descends
    * @param   int     $ancestor_id    The node that is potentially descended from
    * @param   int     $root_id     The ID of the root of the tree.
    *  
    * @return  bool                    True if $descendant_id descends from $ancestor_id, false otherwise
    */
    public function isDescendantOf($descendant_id, $ancestor_id)
    {
        $sql = "SELECT count(*) AS is_descendant
                FROM $this->table descendant, $this->table ancestor
                WHERE descendant.$this->idfield = $descendant_id
                AND ancestor.$this->idfield= $ancestor_id
                AND descendant.$this->lftfield > ancestor.$this->lftfield
                AND descendant.$this->rgtfield < ancestor.$this->rgtfield";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
      
        return  DBUtil::marshallObjects($result, array('is_descendant'));
					
    }
    
    
    /**
    * Check if one node is a child of another node. If either node is not
    * found, then false is returned.
    *
    * @param   int     $child_id       The node that is possibly a child
    * @param   int     $parent_id      The node that is possibly a parent
    * @param    int     $root_id       The id of the tree we are working with
    * @return  bool                    True if $child_id is a child of $parent_id, false otherwise
    */
    public function isChildOf($child_id, $parent_id)
    {
        $where = "WHERE $this->idfield = $child_id
                AND $this->parentidfield = $parent_id";
        
        return DBUtil::selectObjectCount($this->table,$where);      
    }
    
    
    /**
    * Find the number of descendants a node has
    *
    * @param   int     $id     The ID of the node to search for. Pass 0 to count all nodes in the tree.
    * @param   int     $root_id     The ID of the root of the tree.
    * @return  int             The number of descendants the node has, or -1 if the node isn't found.
    */
    public function numDescendants($id)
    {
        if ($id == 0) {
        	return DBUtil::selectObjectCount($this->table,$where); 				
        }
        else {
            $node = $this->getNode($id);
            if (!is_null($node)) {
                return ($node[$this->rgtfield] - $node[$this->lftfield] - 1) / 2;
            }
        }
        return -1;
    }
    
    
    /**
    * Find the number of children a node has
    *
    * @param   int     $id     The ID of the node to search for. Pass 0 to count the first level items
    * @return  int             The number of descendants the node has, or false if the node isn't found.
    */
    public function numChildren($id)
    {
        $where = "WHERE $this->parentidfield = $id";
        
        return DBUtil::selectObjectCount($this->table,$where);  
    }
    
    
    /**
     * Deletes a node an all it's children
     * @param integer $id id of the node to delete
     * @return boolean true
     */
    public function deleteNodeAndChildren($id) {
        //$this->db->beginTransaction();
        
        $node = $this->getNode($id);
        
        $sql = "DELETE FROM $this->table WHERE $this->lftfield BETWEEN ".$node[$this->lftfield]." AND ".$node[$this->rgtfield].";";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        $sql = "UPDATE $this->table SET $this->lftfield = $this->lftfield -
                ROUND((" . $node[$this->rgtfield] . " - " . $node[$this->lftfield] . " + 1))
                WHERE $this->lftfield > " . $node[$this->rgtfield] . ";";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        $sql = "UPDATE $this->table SET $this->rgtfield = $this->rgtfield -
                ROUND((" . $node[$this->rgtfield] . " - " . $node[$this->lftfield] . " + 1))
                WHERE $this->rgtfield > " . $node[$this->rgtfield] . ";";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        //$this->db->commit();
        return true;
    }
    
    
    /**
    * Deletes a node and increases the level of all children by one
    * @param integer $id id of the node to delete
    * @return boolean true
    */
    public function deleteSingleNode($id) {

        
        $node = $this->getNode($id);
        
       //lock table
        $sql = "DELETE FROM " . $this->table . " WHERE $this->lftfield = " . $node[$this->lftfield] . ";";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        $sql = "UPDATE " . $this->table . " SET $this->lftfield = $this->lftfield - 1, $this->rgtfield = $this->rgtfield - 1, $this->levelfield = $this->levelfield - 1
                WHERE $this->lftfield BETWEEN " . $node[$this->lftfield] . " AND " . $node[$this->rgtfield] . ";";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        $sql = "UPDATE " . $this->table . " SET $this->lftfield = $this->lftfield - 2
                WHERE $this->lftfield > " . $node[$this->rgtfield] . ";";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        $sql = "UPDATE " . $this->table . " SET $this->rgtfield = $this->rgtfield - 2
                WHERE $this->rgtfield > " . $node[$this->rgtfield] . ";";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        //unlock;
        return true;
    }
    
    
    /**
     * Moves a node one position to the left staying in the same level
     * @param $nodeId id of the node to move
     * @return boolean true
     */
    public function moveOneLft($nodeId) {
        //$this->db->beginTransaction();
        
        $node = $this->getNode($nodeId);
        $brothernode = $this->getNodeByRgt( $node[$this->lftfield]-1);
        
        if ($brothernode == false){
            ///$this->db->rollback();return false;
        }
        
        $nodeSize = $node[$this->rgtfield] - $node[$this->lftfield] + 1;
        $brotherSize = $brothernode[$this->rgtfield] - $brothernode[$this->lftfield] + 1;
        
        //First we negate the destination node to be sure to not have duplicate left and right
        $sql = "UPDATE $this->table
                SET $this->lftfield = $this->lftfield * (-1), $this->rgtfield = $this->rgtfield * (-1)
                WHERE $this->lftfield >= ".$brothernode[$this->lftfield]." AND $this->rgtfield <= ".$brothernode[$this->rgtfield].";";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        //Then we move the node
        $sql = "UPDATE $this->table
                SET $this->lftfield = $this->lftfield - $brotherSize, $this->rgtfield = $this->rgtfield - $brotherSize
                WHERE $this->lftfield >= ".$node[$this->lftfield]." AND $this->rgtfield <= ".$node[$this->rgtfield].";";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        //Finally we move the "prevous node and put it back in the flux!
        $sql = "UPDATE $this->table
                SET $this->lftfield = ($this->lftfield - $nodeSize)*(-1), $this->rgtfield = ($this->rgtfield - $nodeSize)*(-1)
                WHERE $this->lftfield <= ".$brothernode[$this->lftfield]."*(-1) AND $this->rgtfield >= ".$brothernode[$this->rgtfield]."*(-1);";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        //$this->db->commit();
        return true;
    }
    
    
    /**
     * Moves a node one position to the right staying in the same level
     * @param $nodeId id of the node to move
     * @return boolean true
     */
    public function moveOneRgt($nodeId) {
        //$this->db->beginTransaction();
        
        $node = $this->getNode($nodeId);
        $brothernode = $this->getNodeByLft($node[$this->rgtfield]+1);
        
        if ($brothernode == false){
            //$this->db->rollback();return false;
        }
        
        $nodeSize = $node[$this->rgtfield] - $node[$this->lftfield] + 1;
        $brotherSize = $brothernode[$this->rgtfield] - $brothernode[$this->lftfield] + 1;
        
        //First we negate the destination node to be sure to not have duplicate left and right
        $sql = "UPDATE $this->table
                SET $this->lftfield = $this->lftfield * (-1), $this->rgtfield = $this->rgtfield * (-1)
                WHERE $this->lftfield >= ".$brothernode[$this->lftfield]." AND $this->rgtfield <= ".$brothernode[$this->rgtfield].";";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        } 
        
        //Then we move the node
        $sql = "UPDATE $this->table
                SET $this->lftfield = $this->lftfield + $brotherSize, $this->rgtfield = $this->rgtfield + $brotherSize
                WHERE $this->lftfield >= ".$node[$this->lftfield]." AND $this->rgtfield <= ".$node[$this->rgtfield].";";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        //Finally we move the "next" node and put it back in the flux!
        $sql = "UPDATE $this->table
                SET $this->lftfield = ($this->lftfield + $nodeSize)*(-1), $this->rgtfield = ($this->rgtfield + $nodeSize)*(-1)
                WHERE $this->lftfield <= ".$brothernode[$this->lftfield]."*(-1) AND $this->rgtfield >= ".$brothernode[$this->rgtfield]."*(-1);";
        $result = DBUtil::executeSQL($sql);
        if ($result === false) {
		return null;
        }
        
        //$this->db->commit();
        return true;
    }

    
    /**
     * Update a node
     *
     * @param int $id The id of the node we want to move
     * @param int $parent_id The id of the destination node
     * @param string $title The title of the node
     *
     * @return boolean true
     */
    public function update($id, $parent_id, $title){    
        $this->move($id, $parent_id);
        $sql = "UPDATE $this->table SET $this->namefield = ".$title." WHERE $this->idfield = $id;";
	        $result = DBUtil::executeSQL($sql);
	        if ($result === false) {
			return false;
	        }	        
	        return  true;
    }
    
    
    /**
     * Move a node and it's children to another parent
     *
     * @param int $id The id of the node we want to move
     * @param int $parent_id The id of the destination node
     *
     * @return boolean true of throw an exception
     */
    public function move($id, $parent_id){
        if($id == $parent_id)//Cannot move on itself
            return false;
        
        //$this->db->beginTransaction();
    
        $node = $this->getNode($id);
        
        if($node[$this->parentidfield] == $parent_id)//The node has not moved
        {
            //$this->db->rollback();
            //return false;
        }
        else{
            //Get parent info
            $parent_node = $this->getNode($parent_id);
            //Check if the destination is not a child of the node we move (cause we move the node and her child!)
            if($parent_node[$this->lftfield] > $node[$this->lftfield] AND $parent_node[$this->rgtfield] < $node[$this->rgtfield]){
                //$this->db->rollback();
                return false;
            }
            //Now check the level difference between the node and the new parent_node
            switch($diff = ($node[$this->levelfield] - $parent_node[$this->levelfield])){
                case ($diff == 0)://Same level
                    $diff_level = 1;break;
                case ($diff < 0)://Higher level
                    $diff_level = ($node[$this->levelfield] - $parent_node[$this->levelfield] - 1) * -1; break;
                case ($diff > 0)://Lower level
                    $diff_level = ($node[$this->levelfield] - $parent_node[$this->levelfield] - 1) * -1; break;
            }
            if($node[$this->lftfield] < $parent_node[$this->lftfield])//Move up
            {
                $v_difference = $parent_node[$this->lftfield] - $node[$this->rgtfield];
                $n_diff = $node[$this->rgtfield] + 1 - $node[$this->lftfield];
                
                //Put the node to move in a safe place
                $sql = "UPDATE $this->table SET $this->lftfield = $this->lftfield * (-1), $this->rgtfield = $this->rgtfield * (-1)
                        WHERE $this->lftfield >= ".$node[$this->lftfield]."
                        AND $this->lftfield <= ".$node[$this->rgtfield].";";
		        $result = DBUtil::executeSQL($sql);
		        if ($result === false) {
				return null;
		        }
                
                //Reorganize the tree after the hole
                $sql = "UPDATE $this->table SET $this->lftfield = $this->lftfield - $n_diff
                        WHERE $this->lftfield > ".$node[$this->rgtfield]."
                        AND $this->lftfield <= ".$parent_node[$this->lftfield].";";
		        $result = DBUtil::executeSQL($sql);
		        if ($result === false) {
				return null;
		        }
                
                $sql = "UPDATE $this->table SET $this->rgtfield = $this->rgtfield - $n_diff
                        WHERE $this->rgtfield > ".$node[$this->rgtfield]."
                        AND $this->rgtfield <= ".$parent_node[$this->lftfield].";";
		        $result = DBUtil::executeSQL($sql);
		        if ($result === false) {
				return null;
		        }
                
                //Give the right number to the moved sub-tree
                $sql = "UPDATE $this->table
                        SET $this->lftfield = ($this->lftfield - $v_difference)*(-1),
                        $this->rgtfield = ($this->rgtfield - $v_difference)*(-1),
                        $this->levelfield = $this->levelfield + $diff_level
                        WHERE $this->lftfield <= ".$node[$this->lftfield]."*(-1)
                        AND $this->lftfield >= ".$node[$this->rgtfield]."*(-1);";
		        $result = DBUtil::executeSQL($sql);
		        if ($result === false) {
				return null;
		        }
            }
            elseif($node[$this->lftfield] > $parent_node[$this->lftfield] AND $node[$this->lftfield] > $parent_node[$this->rgtfield])//Move down, becoming a child
            {
                $v_difference = $node[$this->lftfield] - $parent_node[$this->rgtfield];
                $n_diff = $node[$this->rgtfield] + 1 - $node[$this->lftfield];
                
                //Put the node to move in a safe place
                $sql = "UPDATE $this->table SET $this->lftfield = $this->lftfield * (-1), $this->rgtfield = $this->rgtfield * (-1)
                        WHERE $this->lftfield >= ".$node[$this->lftfield]."
                        AND $this->lftfield <= ".$node[$this->rgtfield].";";
		        $result = DBUtil::executeSQL($sql);
		        if ($result === false) {
				return null;
        }
                
                //Reorganize the tree after the hole
                $sql = "UPDATE $this->table SET $this->lftfield = $this->lftfield + $n_diff
                        WHERE $this->lftfield > ".$parent_node[$this->rgtfield]."
                        AND $this->lftfield < ".$node[$this->lftfield].";";
		        $result = DBUtil::executeSQL($sql);
		        if ($result === false) {
				return null;
		        }
                
                $sql = "UPDATE $this->table SET $this->rgtfield = $this->rgtfield + $n_diff
                        WHERE $this->rgtfield >= ".$parent_node[$this->rgtfield]."
                        AND $this->rgtfield < ".$node[$this->lftfield].";";
		        $result = DBUtil::executeSQL($sql);
		        if ($result === false) {
				return null;
		        }
                
                //Give the right number to the moved sub-tree
                $sql = "UPDATE $this->table
                        SET $this->lftfield = ($this->lftfield + $v_difference)*(-1),
                        $this->rgtfield = ($this->rgtfield + $v_difference)*(-1),
                        $this->levelfield = $this->levelfield + $diff_level
                        WHERE $this->lftfield <= ".$node[$this->lftfield]."*(-1)
                        AND $this->lftfield >= ".$node[$this->rgtfield]."*(-1);";
		        $result = DBUtil::executeSQL($sql);
		        if ($result === false) {
				return null;
        }
            }
            elseif($node[$this->lftfield] > $parent_node[$this->lftfield] AND $node[$this->lftfield] < $parent_node[$this->rgtfield])//Move down, beeing a child
            {
                $v_difference = $parent_node[$this->rgtfield] - $node[$this->rgtfield] - 1;
                $n_diff = $node[$this->rgtfield] + 1 - $node[$this->lftfield];
                
                //Put the node to move in a safe place
                $sql = "UPDATE $this->table SET $this->lftfield = $this->lftfield * (-1), $this->rgtfield = $this->rgtfield * (-1)
                        WHERE $this->lftfield >= ".$node[$this->lftfield]."
                        AND $this->lftfield <= ".$node[$this->rgtfield].";";
		        $result = DBUtil::executeSQL($sql);
		        if ($result === false) {
				return null;
        }
                
                //Reorganize the tree after the hole
                $sql = "UPDATE $this->table SET $this->lftfield = $this->lftfield - $n_diff
                        WHERE $this->lftfield > ".$node[$this->rgtfield]."
                        AND $this->lftfield < ".$parent_node[$this->rgtfield].";";
		        $result = DBUtil::executeSQL($sql);
		        if ($result === false) {
				return null;
        }
                
                $sql = "UPDATE $this->table SET $this->rgtfield = $this->rgtfield - $n_diff
                        WHERE $this->rgtfield > ".$node[$this->rgtfield]."
                        AND $this->rgtfield < ".$parent_node[$this->rgtfield].";";
		        $result = DBUtil::executeSQL($sql);
		        if ($result === false) {
				return null;
        }
                
                //Give the right number to the moved sub-tree
                $sql = "UPDATE $this->table
                        SET $this->lftfield = ($this->lftfield - $v_difference)*(-1),
                        $this->rgtfield = ($this->rgtfield - $v_difference)*(-1),
                        $this->levelfield = $this->levelfield + $diff_level
                        WHERE $this->lftfield <= ".$node[$this->lftfield]."*(-1)
                        AND $this->lftfield >= ".$node[$this->rgtfield]."*(-1);";
		        $result = DBUtil::executeSQL($sql);
		        if ($result === false) {
				return null;
        }
            }
            //Change the parent id of the moved node
            $sql = "UPDATE $this->table SET $this->parentidfield = $parent_id WHERE $this->idfield = $id;";
	        $result = DBUtil::executeSQL($sql);
	        if ($result === false) {
			return null;
	        }


            return true;
        }
    }
    

	/**
    * get all tree
    */
    public function collectionToTree($collection){
						

        $tree = array();
        $l = 0;

        if (count($collection) > 0) {
                // Node Stack. Used to help building the hierarchy
                $stack = array();

                foreach ($collection as $node) {
                        $item = $node;
                        $item['children'] = array();

                        // Number of stack items
                        $l = count($stack);

                        // Check if we're dealing with different levels
                        while($l > 0 && $stack[$l - 1][$this->levelfield] >= $item[$this->levelfield]) {
                                array_pop($stack);
                                $l--;
                        }

                        // Stack is empty (we are inspecting the root)
                        if ($l == 0) {
                                // Assigning the root node
                                $i = count($tree);
                                $tree[$i] = $item;
                                $stack[] = & $tree[$i];
                        } else {
                                // Add node to parent
                                $i = count($stack[$l - 1]['children']);
                                $stack[$l - 1]['children'][$i] = $item;
                                $stack[] = & $stack[$l - 1]['children'][$i];
                        }
                }
        }

        return $tree;
	
	
    }
   

    /***************************** Helpers ********************************/

 
 	/**
    * Browse tree
    */
    public function getBrowser($current = 1){
 
 	$path = $this->getPath($current);	
	$collection = array();
	
	foreach ($path as $key => $node){
	$collection[] = $node;				
	$children[$key] = $this->getChildren($node[$this->idfield],true);
	if(is_array($children[$key])){
	foreach ($children[$key] as $key => $child) {	
		$collection[] =  $child;	
	}						
	}						
	}

	$clean_collection = array_values(array_combine(array_map(function ($i) { return $i['id']; }, $collection), $collection));

 	foreach($clean_collection as $c=>$key) {
        $sort_lft[] = $key[$this->lftfield];
    }

    array_multisort($sort_lft, SORT_ASC, $clean_collection);


	$tree = $this->collectionToTree($clean_collection);
	
	return $tree; 
 
	}
 
 
 
 
    
	/**
    * get all tree
    */
    public function getTree($parent = 1){
						
		$collection = array();	

		$sql = "SELECT node.".$this->idfield.",
					   node.".$this->namefield.",
					   node.".$this->levelfield.",
					   node.".$this->lftfield.",
					   node.".$this->rgtfield."		
		FROM ".$this->table." AS node ,".$this->table." AS parent
		WHERE node.".$this->lftfield." BETWEEN parent.".$this->lftfield." AND parent.".$this->rgtfield."
		AND parent.".$this->idfield." = '{$parent}'
		ORDER BY node.".$this->lftfield."";


        $result = DBUtil::executeSQL($sql);

        if ($result === false) {
           // return LogUtil::registerError(__f('Error in %1$s: %2$s.', array('accessapi.getAlbumAccess', 'Could not retrieve the access level.'), $dom));
        }
        $collection = DBUtil::marshallObjects($result, array('id','title','nestedsetlevel','nestedsetleft','nestedsetright'));		


        $trees = array();
        $l = 0;

        if (count($collection) > 0) {
                // Node Stack. Used to help building the hierarchy
                $stack = array();

                foreach ($collection as $node) {
                        $item = $node;
                        $item['children'] = array();

                        // Number of stack items
                        $l = count($stack);

                        // Check if we're dealing with different levels
                        while($l > 0 && $stack[$l - 1]['nestedsetlevel'] >= $item['nestedsetlevel']) {
                                array_pop($stack);
                                $l--;
                        }

                        // Stack is empty (we are inspecting the root)
                        if ($l == 0) {
                                // Assigning the root node
                                $i = count($trees);
                                $trees[$i] = $item;
                                $stack[] = & $trees[$i];
                        } else {
                                // Add node to parent
                                $i = count($stack[$l - 1]['children']);
                                $stack[$l - 1]['children'][$i] = $item;
                                $stack[] = & $stack[$l - 1]['children'][$i];
                        }
                }
        }

        return $trees;
	
	
    }	    
    
        
    /**
    * Create a simple unordered list of the tree
    * This function is a "helper", you can create your own...
    *
    * @param array $arResult The array containing the tree
    *
    * @return string Return the unordered list html.
    */
    public function getList($arResult){
        $diff = 0;
        foreach($arResult as $result){
            if($lastlevel != $result->level){
                if($lastlevel < $result->level){
                    $html .= "<ul>\n";
                    $diff++;
                }
                else {
                    $html .= "</li>\n</ul>\n</li>\n";
                    $diff--;
                }               
            }
            else
                $html .= "</li>\n";
            
            $html .= "<li>$result->title";
            
            $lastlevel = $result->level;
        }
        $html .= str_repeat("</li>\n</ul>\n", $diff);
        return $html;
    }
    
    
    /**
    * Create an array ready for creating a dropdownlist (label and id)
    * The label are prepared like "\Root, \Root\Child1, \Root\Child2..."
    * This function is a "helper", you can create your own, use template or wathever...
    * 
    * @param array $arResult The array containing the tree
    * @param int $id The id of the node we are editing. If not null, remove it from the ddl.
    * @param string $ParamForValue The field that will be in the value of the ddl
    *
    * @return array The array containing objects with "label" and "id"
    */
    public function getDdl($arResult, $id = null, $ParamForValue = 'id'){
        $previous = $concat = '';
        $arSelect = array();
        $lastlevel = -1;
        foreach($arResult as $result){
            if($lastlevel != $result->level){
                if($lastlevel < $result->level){
                    $concat .= $previous;
                }
                else {
                    $diff = $lastlevel - $result->level;
                    for($i=0;$i<$diff;$i++)
                        $concat = substr($concat,0,strrpos($concat,'\\',2));
                }               
            }
            /*$object = new stdClass();
            $object->label = $concat.'\\'.$result->title;
            $object->id = $result->id;
            array_push($arSelect,$object);*/
            if($id == null OR $id != $result->id)
                $arSelect[$result->{$ParamForValue}] = $concat.'\\'.$result->title;
            
            $previous = '\\'.$result->title;
            $lastlevel = $result->level;
            
        }
        return $arSelect;
    }
    
    
    /**
    * Create an unordered list of the tree with link to the move and delete actions
    * You must have the delete, moveup and movedown action define in your controller.
    * This function is a "helper", you can create your own, use template or wathever...
    *
    * @param array $arResult The array containing the tree
    * @param string $sModCtrl The Jelix module and controller name to use ex:'module~controller'
    * @param string $IdParam The name of the primary key param, default is 'id'
    * @param string $RootIdParam The name of the root_id param, default is 'root_id'
    * @param  array $MoreParam An array containing other params...
    * @param bool $LinkRoot Put link for editing, deleteing, etc on root
    * @param string $sDel The string for the Delete button
    * @param string $sMvUp The string for the MoveUp button
    * @param string $sMvDown The string for the MoveDown button
    *
    * @return string Return the unordered list html.
    */     
    public function getFullListWithLink($arResult,$sModCtrl = 'commons~nested', $IdParam = 'id', $RootIdParam = 'root_id', $MoreParam = array(), $LinkRoot = false, $sDel = '⌫', $sMvUp = '▲', $sMvDown = '▼'){
        $diff = 0;
        $lastlevel = -1;
        $isRoot = true;
        $html = '';
        $classTree = 'class="ejTree"';
        foreach($arResult as $result){
            if($lastlevel != $result->level){
                if($lastlevel < $result->level){
                    $html .= "<ul $classTree>\n";
                    $classTree = '';
                    $diff++;
                }
                else {
                    $diff = $lastlevel - $result->level;
                    for($i=1;$i<=$diff;$i++)
                        $html .= "</li>\n</ul>\n</li>\n";
                }               
            }
            else
                $html .= "</li>\n";
            
            $arrayparam = array($IdParam=>$result->{$this->idfield},$RootIdParam=>$result->{$this->rootidfield});
            if($isRoot AND !$LinkRoot)
            {
                $html .= '<li>'.$result->{$this->namefield};
                $isRoot = false;
            }
            else{
                $html .= '<li><a class="nestedUpdate" href="'.jUrl::get($sModCtrl.":preupdate@classic", $arrayparam).'" >'.$result->{$this->namefield}.'</a>';
                $html .= ' <a class="nestedDelete" href="'.jUrl::get($sModCtrl.":delete@classic", $arrayparam).'" ><span>'.$sDel.'</span></a>';
                $html .= ' <a class="nestedMvUp" href="'.jUrl::get($sModCtrl.":moveup@classic", $arrayparam).'" ><span>'.$sMvUp.'</span></a>';
                $html .= ' <a class="nestedMvDown" href="'.jUrl::get($sModCtrl.":movedown@classic", $arrayparam).'" ><span>'.$sMvDown.'</span></a>';
            }
            
            $lastlevel = $result->level;
        }
        $html .= str_repeat("</li>\n</ul>\n", $diff);
        return $html;
    }
    
    /**
     *    The first method I made that return an unordered list ready for css and menuing
     *
     **/
    public static function TreeList($cssid,$arObjet,$idfield,$lang,$typechamp,$cssclass,$link = '#',$dellink,$editlink,$notfirst = false,$notid = -1,$order = false,$orderlink = '',$del = 1,$delimg = null,$edit = 1,$editimg = null)
        {
                $imgdel = 'Images/Btn/Delete.png';
                if($delimg != null) $imgdel = $delimg;
                if($del == 1) $htmldel = '<span class="list_effacer"><a href="'.$dellink.'%s" ><img src="'.$imgdel.'" alt="Effacer" /></a></span>';
                else $htmldel = '';
                
                $imgedit = 'Images/Btn/pencil.png';
                if($editimg != null) $imgedit = $editimg;
                if($del == 1) $htmledit = '<span class="list_editer"><a href="'.$editlink.'%s" ><img src="'.$imgedit.'" alt="Editer" /></a></span>';
                else $htmledit = '';
                
                if ($order)
                {
                        $html_dec = '<span class="list_ordredec"><a href="'.$orderlink.'%s&w=dec" alt="Avant" >↑</a></span>';
                        $html_inc = '<span class="list_ordreinc"><a href="'.$orderlink.'%s&w=inc" alt="Après" >↓</a></span>';
                }
                else 
                {
                        $html_dec = '';
                        $html_inc = '';
                }
                
                $html_list = '';
                $i = 0;
                $ref{$i} = 0;
                foreach($arObjet as $objet)
                {
                                if($objet->fk_id_parent == 0)//Elément racine
                                {
                                                $html_list .= "<ul id=\"$cssid\">\r";
                                                $nrighttotal = $objet->nright;
                                }
                                elseif($objet->fk_id_parent != 0 AND ($objet->nright - $objet->nleft) == 1 AND $objet->nlevel == 1)//Titre de niveau 1 sans sous niveau
                                {
                                        if($notfirst)//Verifie que le premier niveau sera un lien ou non
                                                $html_list .= "<li><span class=\"".$cssclass."\">".$objet->Get_ContentByLangType($lang,$typechamp)."</span></li>\r";
                                        else 
                                                $html_list .= "<li><span class=\"".$cssclass."\"><a href=\"".$link.$objet->$idfield."\" >".$objet->Get_ContentByLangType($lang,$typechamp)."</a></span>".sprintf($htmledit,$objet->$idfield).sprintf($htmldel,$objet->$idfield).sprintf($html_dec,$objet->$idfield).sprintf($html_inc,$objet->$idfield)."</li>\r";
                                }
                                elseif($objet->fk_id_parent != 0 AND ($objet->nright - $objet->nleft) != 1 AND $objet->nlevel == 1)//Nouveau noeud
                                {
                                        $i++;
                                        $ref{$i}=$objet->nright;
                                        if($notfirst)
                                                $html_list .= "<li><span class=\"".$cssclass."\">".$objet->Get_ContentByLangType($lang,$typechamp)."</span><ul>\r";
                                        else 
                                                $html_list .= "<li><span class=\"".$cssclass."\"><a href=\"".$link.$objet->$idfield."\" >".$objet->Get_ContentByLangType($lang,$typechamp)."</a></span>".sprintf($htmledit,$objet->$idfield).sprintf($htmldel,$objet->$idfield).sprintf($html_dec,$objet->$idfield).sprintf($html_inc,$objet->$idfield)."<ul>\r";
                                }
                                elseif($objet->fk_id_parent != 0 AND ($objet->nright - $objet->nleft) == 1 AND $i != 0)//Element de liste normal
                                {
                                        if($notid == $objet->$idfield)
                                                $html_list .= "<li><span class=\"".$cssclass."\">".$objet->Get_ContentByLangType($lang,$typechamp)."</span></li>\r";
                                        else    
                                                $html_list .= "<li><span class=\"".$cssclass."\"><a href=\"".$link.$objet->$idfield."\" >".$objet->Get_ContentByLangType($lang,$typechamp)."</a></span>".sprintf($htmledit,$objet->$idfield).sprintf($htmldel,$objet->$idfield).sprintf($html_dec,$objet->$idfield).sprintf($html_inc,$objet->$idfield)."</li>\r";
                                }
                                elseif($objet->fk_id_parent != 0 AND ($objet->nright - $objet->nleft) != 1 AND $i != 0)//Sous menu, noeud
                                {
                                        if($notid == $objet->$idfield)  
                                                $html_list .= "<li><span class=\"".$cssclass."\">".$objet->Get_ContentByLangType($lang,$typechamp)."</span><ul>\r";
                                        else 
                                                $html_list .= "<li><span class=\"".$cssclass."\"><a href=\"".$link.$objet->$idfield."\" >".$objet->Get_ContentByLangType($lang,$typechamp)."</a></span>".sprintf($htmledit,$objet->$idfield).sprintf($htmldel,$objet->$idfield).sprintf($html_dec,$objet->$idfield).sprintf($html_inc,$objet->$idfield)."<ul>\r";
                                        $i++;
                                        $ref{$i}=$objet->nright;
                                }
                                if($objet->nright == $ref{$i}-1)//Fin d'un sous niveau
                                {
                                                $j=1;
                                                while($i>=0 AND $objet->nright == $ref{$i}-$j)
                                                {
                                                                $html_list .= "</ul>\r</li>\r";
                                                                $i--;$j++;
                                                }
                                }
                        
                }
                $html_list .= '</ul><br/>';
                return $html_list;
        }


}