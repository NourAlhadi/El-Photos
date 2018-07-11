<?php

class Photo_model extends CI_Model{

    /**
     * @return Photo_model[], an Array of best trending photos
     */
    public function get_best_photos(){
        $query = $this->db->order_by("loves desc, views desc, date desc")->get('photo');
        return $query->result();
    }


    /**
     * @param $user_id, the id of base user
     * @return Photo_model[], an Array of $user community photos
     */
    public function get_community_photos($user_id){
        $query = $this->db->order_by("loves desc, views desc, date desc")->get('photo')->result();
        $friends = $this->db->where('me',$user_id)->get('follow')->result();
        $arr = array();
        foreach ($friends as $friend){
            array_push($arr,$friend->him);
        }
        sort($arr);
        $photos = array();
        foreach ($query as $photo){
            $id = $photo->uploader;
            if ($id == $user_id || binary_search($arr,$id)){
                array_push($photos,$photo);
            }
        }
        return $photos;
    }

    /**
     * @return Photo_model[], an Array of all photos
     */
    public function get_photos(){
        $query = $this->db->get('photo');
        return $query->result();
    }

    /**
     * @param $photo_id, the id to required photo
     * @return Photo_model, the photo with id = $photo_id
     */
    public function select_photo($photo_id){
        $this->db->where('id',$photo_id);
        $query = $this->db->get('photo');
        return $query->result();
    }

    /**
     * Insert a photo to database
     *
     * @param $data, specifiers of a photo
     */
    public function insert_photo($data){
        $query = $this->db->insert('photo',$data);
    }

    /**
     * Add a view to the counter of the specified photo
     *
     * @param $photo_id, the id of the photo
     */
    public function add_view($photo_id){
        $this->db->where('id',$photo_id);
        $this->db->select('views');
        $views = $this->db->get('photo')->row();
        $views = $views->views;

        $views = $views + 1;

        $this->db->set('views', $views);
        $this->db->where('id', $photo_id);
        $this->db->update('photo');
    }

    /**
     * Add a love from user to photo
     *
     * @param $user_id, the user id
     * @param $photo_id, the photo id
     * @return bool, the result of adding operation
     */
    public function add_love($user_id,$photo_id){
        $this->db->where('user_id',$user_id)->where('photo_id',$photo_id);
        $query = $this->db->get('user_loves');
        if ($query->num_rows() != 0) return false;

        $data = array(
            "user_id" => $user_id,
            "photo_id" => $photo_id
        );
        $this->db->insert('user_loves',$data);


        $this->db->where('id',$photo_id);
        $this->db->select('loves');
        $loves = $this->db->get('photo')->row();
        $loves = $loves->loves;

        $loves = $loves + 1;

        $this->db->set('loves', $loves);
        $this->db->where('id', $photo_id);
        $this->db->update('photo');
    }


}