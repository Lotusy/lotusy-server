<?php
class ReplyDao extends ReplyDaoGenerated {

//========================================================================================== public

    public static function getRepliesByCommentId($commentId, $start, $size) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                        ->where('comment_id', $commentId)
                        ->limit($start, $size)
                        ->findList();

        return self::makeObjectsFromSelectListResult($res, 'ReplyDao');
    }

    public static function getReplyCountByCommentId($commentId) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table)
                       ->where('comment_id', $commentId)
                       ->find();

        return $res['count'];
    }

// ============================================ override functions ==================================================

    protected function beforeInsert() {
        $date = date('Y-m-d H:i:s');
        $this->setCreateTime($date);
    }
}
?>