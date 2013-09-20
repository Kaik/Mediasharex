<?php

class Mediasharex_Access_Full {
        

   public function getAccess() 
	{								

	$access = array('Public' => 0,
	 				'Private' => 1,
					'Only me' => 2
	);	
	
	
	return $access;
	}

   public function getAccessSelect() 
	{								
        $access = Mediasharex_Util_Access::getAccess();
		$access_select = array();
		foreach ($access as $name => $value) {
		$access_select[] = array('text' => $name,'value'=> $value);				
		}
		return $access_select;	
	}	
	
	
   public function hasAlbumAccess($albumId, $access, $viewKey)
    {
        // Admin can do everything
        if (SecurityUtil::checkPermission('mediashare::', '::', ACCESS_ADMIN)) {
            return true;
        }

        $userId = (int)pnUserGetVar('uid');

        // Owner can do everything
        if (!($album = pnModAPIFunc('mediashare', 'user', 'getAlbum', array('albumId' => $albumId)))) {
            return false;
        }
        if ($album['ownerId'] == $userId) {
            return true;
        }

        // Don't enable any edit access if not having normal Zikula edit access
        if (!SecurityUtil::checkPermission('mediashare::', '::', ACCESS_EDIT)) {
            $access = $access & ~mediashareAccessRequirementEditSomething;
        }

        // Must have normal PN read access to the module
        if (!SecurityUtil::checkPermission('mediashare::', '::', ACCESS_READ)) {
            return false;
        }

        // Anonymous is not allowed to add stuff, so remove those bits
        if (!pnUserLoggedIn()) {
            $access = $access & ~mediashareAccessRequirementAddSomething;
        }

        pnModDBInfoLoad('Groups'); // Make sure groups database info is available

        $pntable = pnDBGetTables();

        $accessTable      = $pntable['mediashare_access'];
        $accessColumn     = $pntable['mediashare_access_column'];
        $membershipTable  = $pntable['group_membership'];
        $membershipColumn = $pntable['group_membership_column'];

        $invitedAlbums = pnModAPIFunc('mediashare', 'invitation', 'getInvitedAlbums', array());
        if (is_array($invitedAlbums) && $invitedAlbums[$albumId] && ($access & mediashareAccessRequirementView) == mediashareAccessRequirementView) {
            return true;
        }

        $sql = "SELECT COUNT(*)
                  FROM $accessTable
             LEFT JOIN $membershipTable
                    ON $membershipColumn[gid] = $accessColumn[groupId]
                   AND $membershipColumn[uid] = $userId
                 WHERE $accessColumn[albumId] = $albumId
                   AND ($accessColumn[access] & $access) != 0
                   AND ($membershipColumn[gid] IS NOT NULL OR $accessColumn[groupId] = -1)";

        $result = DBUtil::executeSQL($sql);

        if ($result === false) {
            return LogUtil::registerError(__f('Error in %1$s: %2$s.', array('accessapi.hasAlbumAccess', 'Could not retrieve the user privilegies.'), $dom));
        }

        $hasAccess = DBUtil::marshallObjects($result, array('count'));

        return $hasAccess[0]['count'] > 0;
    }

   public function getAlbumAccess($albumId)
    {
        // Admin can do everything
        if (SecurityUtil::checkPermission('mediashare::', '::', ACCESS_ADMIN)) {
            return 0xFF;
        }

        if (!SecurityUtil::checkPermission('mediashare::', '::', ACCESS_READ)) {
            return 0x00;
        }

        $userId = (int)pnUserGetVar('uid');

        // Owner can do everything
        if (!($album = pnModAPIFunc('mediashare', 'user', 'getAlbum', array('albumId' => $albumId)))) {
            return false;
        }
        if ($album['ownerId'] == $userId) {
            return 0xFF;
        }

        // Make sure groups database info is available
        pnModDBInfoLoad('Groups');

        $pntable = pnDBGetTables();

        $accessTable      = $pntable['mediashare_access'];
        $accessColumn     = $pntable['mediashare_access_column'];
        $membershipTable  = $pntable['group_membership'];
        $membershipColumn = $pntable['group_membership_column'];

        $sql = "SELECT $accessColumn[access]
                  FROM $accessTable
             LEFT JOIN $membershipTable
                    ON $membershipColumn[gid] = $accessColumn[groupId]
                   AND $membershipColumn[uid] = '$userId'
                 WHERE $accessColumn[albumId] = '$albumId'
                   AND ($membershipColumn[gid] IS NOT NULL OR $accessColumn[groupId] = -1)";

        $result = DBUtil::executeSQL($sql);

        if ($result === false) {
            return LogUtil::registerError(__f('Error in %1$s: %2$s.', array('accessapi.getAlbumAccess', 'Could not retrieve the access level.'), $dom));
        }

        $result = DBUtil::marshallObjects($result, array('access'));

        $access = 0x00;
        foreach (array_keys($result) as $k) {
            $access |= (int)$result[$k]['access'];
        }

        $invitedAlbums = pnModAPIFunc('mediashare', 'invitation', 'getInvitedAlbums');
        if (is_array($invitedAlbums) && isset($invitedAlbums[$albumId])) {
            $access |= mediashareAccessRequirementView;
        }

        return $access;
    }

    public function getAccessibleAlbumsSql($albumId, $access, $field)
    {
        // Admin can do everything
        if (SecurityUtil::checkPermission('mediashare::', '::', ACCESS_ADMIN)) {
            return '1=1';
        }
        // Forbidden read can do nothing
        if (!SecurityUtil::checkPermission('mediashare::', '::', ACCESS_READ)) {
            return '1=0';
        }

        $userId = (int)pnUserGetVar('uid');

        // Make sure groups database info is available
        pnModDBInfoLoad('Groups');

        $pntable = pnDBGetTables();

        $albumsTable      = $pntable['mediashare_albums'];
        $albumsColumn     = $pntable['mediashare_albums_column'];
        $accessTable      = $pntable['mediashare_access'];
        $accessColumn     = $pntable['mediashare_access_column'];
        $membershipTable  = $pntable['group_membership'];
        $membershipColumn = $pntable['group_membership_column'];

        $parentAlbumSql = '';
        if ($albumId != null) {
            $parentAlbumSql = "$albumsColumn[parentAlbumId] = $albumId AND";
        }

        $sql = "SELECT DISTINCT $albumsColumn[id]
                           FROM $albumsTable
                      LEFT JOIN $accessTable
                             ON $accessColumn[albumId] = $albumsColumn[id]
                      LEFT JOIN $membershipTable
                             ON $membershipColumn[gid] = $accessColumn[groupId]
                            AND $membershipColumn[uid] = $userId
                          WHERE $parentAlbumSql
                                (
                                  ($accessColumn[access] & $access) != 0 AND ($membershipColumn[gid] IS NOT NULL OR $accessColumn[groupId] = -1)
                                  OR  $albumsColumn[ownerId] = $userId
                                )";

        $result = DBUtil::executeSQL($sql);

        if ($result === false) {
            return LogUtil::registerError(__f('Error in %1$s: %2$s.', array('accessapi.getAccessibleAlbumsSql', 'Could not retrieve the accessible albums.'), $dom));
        }

        $ids = DBUtil::marshallObjects($result, array('id'));

        $invitedAlbums = pnModAPIFunc('mediashare', 'invitation', 'getInvitedAlbums');

        // collect all the accessible album IDs
        $albumids = array();
        foreach ($ids as $id) {
            $albumids[] = (int)$id['id'];
        }
        if (is_array($invitedAlbums) && ($access & mediashareAccessRequirementView)) {
            foreach ($invitedAlbums as $invAlbumId => $ok) {
                if ($ok) {
                    $albumids[] = (int)$invAlbumId;
                }
            }
        }

        // sintetize the query
        if (!empty($albumids)) {
            $albumids = "'".implode("', '", $albumids)."'";
        } else {
            $albumids = '';
        }

        return $albumids == '' ? '1=0' : "$field IN ($albumids)";
    }

    public function hasItemAccess($mediaId, $access, $viewKey)
    {
        if (!($item = pnModAPIFunc('mediashare', 'user', 'getMediaItem', array('mediaId' => $mediaId)))) {
            return false;
        }

        // Owner can do everything
        $userId = (int)pnUserGetVar('uid');
        if ($item['ownerId'] == $userId) {
            return true;
        }

        $albumId = $item['parentAlbumId'];

        return $this->hasAlbumAccess($albumId, $access, $viewKey);
    }

    public function hasUserRealNameAccess()
    {
        return true;
    }	
	
	
	
	
	
	     
}