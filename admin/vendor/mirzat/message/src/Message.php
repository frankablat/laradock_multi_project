<?php
/**
 * Created by Mirzat
 * Date: 2017/9/8
 * Time: 18:56
 */
namespace Mirzat\Message;
use Exeption;
class Message
{
    /*
     * 统一化的消息输出结构。将后端数据格式化输出到后盾。
     * 返回数据字段均用数组或null
     * */
    private $error,$message,$data,$code;

    public function __construct($error=0,$message="success",$data=null,$code=0)//构造函数提供默认参数，实现多态，简化操作。
    {
        /*
         * @param int 有错误就是1，没错误就是0；
         * @param string 错误提示信息
         * @param mixed  错误
         * @return void
         * */
        $this->error = $error;
        $this->message = $message;
        $this->data = $data;
        $this->code = $code;
    }

    public function getDataSize(){
        $size = 0;
        if(is_array($this->data)){
            return  sizeof($this->data);
        }

        if ($this->data instanceof \Countable){
            return  count($this->data);
        }

        return $size;
    }

    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    public static function makeError($message="internal error",$data=null,$code=0){//静态函数简化错误消息
        return new Message(1,$message,$data,$code);
    }

    public static function makeSuccess($data=null,$message=null,$code=null){//静态函数简化成功消息
        return new Message(0,"success",$data,$code);
    }

    public function toString(){//定义显式序列化函数
        return $this->__toString();
    }


    public function __toString()//重写隐式序列化函数
    {
        return json_encode(["error"=>$this->getError(),"message"=>$this->message=$this->getMessage(),"size"=>$this->getDataSize(),"data"=>$this->getData(),"code"=>$this->getCode()]);
    }

    public function success(){
        return !$this->error;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }
}