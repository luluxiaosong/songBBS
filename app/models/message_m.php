<?php if (!defined('BASEPATH')) exit('No direct script assces allowed');

class message_m extends CI_Model
{
    //我的消息
    public function myMessage($uid)
    {

        //查询我的消息
        $this->db->select('u.username,u.avatar,u.uid,content,create_time,sender_uid,receiver_uid,is_reading,id')
                 ->where('receiver_uid',$uid)
                 ->from('messages')
                 ->join('users u','u.uid = messages.sender_uid','left');
        $res = $this->db->get()->result_array();
//        p($res);
        return $res;
    }
    //未读消息数 is_reading = 0
    public function messages_unreading($uid)
    {

    }
}
