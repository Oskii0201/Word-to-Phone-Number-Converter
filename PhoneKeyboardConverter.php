<?php
class PhoneKeyboardConverter{

    private $dictionary;

    public function __construct()
    {
        $this->dictionary = array(
          'a' => '2',
          'b' => '22',
          'c' => '222',
          'd' => '3',
          'e' => '33',
          'f' => '333',
          'g' => '4',
          'h' => '44',
          'i' => '444',
          'j' => '5',
          'k' => '55',
          'l' => '555',
          'm' => '6',
          'n' => '66',
          'o' => '666',
          'p' => '7',
          'q' => '77',
          'r' => '777',
          's' => '7777',
          't' => '8',
          'u' => '88',
          'v' => '888',
          'w' => '9',
          'x' => '99',
          'y' => '999',
          'z' => '9999',
            ' ' => '0'
        );

    }

    public function checkType($post){
        $result = '';
        if($post['action'] == 'convertToNumeric'){
            $result = $this->convertToNumeric($post['data']);
        }elseif ($post['action'] == 'convertToString'){
            $result = $this->convertToString($post['data']);
        }
        return $result;
    }

    function convertToNumeric($data){
        if(empty($data)){
            return 'Bad data';
        }
        $result = array();
        $data = str_split(strtolower($data));
        foreach ($data as $char){
            if(array_key_exists($char, $this->dictionary)){
                $result[] = $this->dictionary[$char];
            }else{
                $result[] = $char;
            }
        }
        $result = implode(',', $result);
        return $result;
    }

    function convertToString($data){
        if(empty($data)){
            return 'Bad data';
        }
        $result = '';
        $data = explode(',', $data);
        foreach ($data as $number){
            if(in_array($number, $this->dictionary)){
                $char = array_keys($this->dictionary, $number);
                $result .= $char[0];
            }
        }
        return $result;
    }
}
?>
