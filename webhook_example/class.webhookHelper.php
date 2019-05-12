<?PHP

class webhookHelper {
    private $response = array();

    public function addReplyTextMessage($username,$jid,$message){
        $this->response[] = array(
            'reqType'=>'sendTextMessage',
            'username'=>$username,
            'jid'=>$jid,
            'message'=>base64_encode($message)
        );
    }

    public function addReplyLinkMessage($username,$jid,$LinkTitle,$LinkMessage,$LinkURL,$ThumbURL){
        $this->response[] = array(
            'reqType'=>'sendTextMessage',
            'username'=>$username,
            'jid'=>$jid,
            'LinkTitle'=>$LinkTitle,
            'message' => base64_encode($LinkMessage),
            'LinkURL'=>$LinkURL,
            'ThumbURL'=>$ThumbURL
        );
    }

    public function addReplyVoiceMessage($username,$jid,$message){
        $this->response[] = array(
            'reqType'=>'sendVoiceMessage',
            'username'=>$username,
            'jid'=>$jid,
            'fileName'=>$fileName,
            'fileURL'=>$fileURL,
        );
    }

    public function addReplyMediaMessage($username,$jid,$fileName,$fileURL,$caption=""){
        $this->response[] = array(
            'reqType'=>'sendMediaMessage',
            'username'=>$username,
            'jid'=>$jid,
            'fileName'=>$fileName,
            'fileURL'=>$fileURL,
            'caption'=>$caption
        );
    }

    public function addReplyLocationMessage($username,$jid,$Latitude,$Longitude,$Name="",$Address="",$Url=""){
        $this->response[] = array(
            'reqType'=>'sendLocation',
            'username'=>$username,
            'jid'=>$jid,
            'Latitude'=>$Latitude,
            'Longitude'=>$Longitude,
            'Name'=>$Name,
            'Address'=>$Address,
            'Url'=>$Url,
        );
    }

    public function addReplyVcardMessage($username,$jid,$DisplayName,$vCard){
        $this->response[] = array(
            'reqType'=>'sendVcard',
            'username'=>$username,
            'jid'=>$jid,
            'DisplayName'=>$DisplayName,
            'vCard'=>$vCard,
        );
    }

    public function jsonResponse(){
        echo json_encode($this->response,JSON_PRETTY_PRINT);
    }
}

?>
