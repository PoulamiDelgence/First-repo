<?php
//added by Poulami
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Session\Container;

class DeveloperTable
{
	protected $tableGateWay;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGWay = $tableGateway;
	}
    
    public function getDeveloperWithId($id) 
    {
        $id = (int) $id;
        
        //echo $id;
        
        $rowset = $this->tableGWay->select(array('id' => $id));
        $row = $rowset->current();
        
        if(!$row)
        {
            throw new \Exception("Row not found");
        }
        
       return $row;
    }
    
    public function getDeveloper($uname,$pwd) 
    {
        $rowset = $this->tableGWay->select(array('uname' => $uname,'pwd'=>$pwd));
        
        $rset = array();
        
        foreach($rowset as $rset){
            $arr['id']=$rset->id;
        }
        
        
        
        $id = $arr['id'];
        $user_session = new Container('devId');
        $user_session->devId = $id;
    
        if(0 === $rowset->count())
        {
            echo "Row not found";
        }
        else
        {
            return $rowset;
        }
        
        
    }
	
	public function saveDeveloper(Developer $dev) //edited by Poulami
	{
	   $data = array(
			'fName' => $dev->fName,
				'lName'=> $dev->lName,
				'eId' => $dev->eId,
				'uname'=> $dev->uname,
				'pwd'=> $dev->pwd 
		);
  
        $id = (int) $dev->id;
        
        if($id == 0)
        {
            $this->tableGWay->insert($data); 
            
            $id = $this->tableGWay->lastInsertValue;
            $user_session = new Container('devId');
            $user_session->devId = $id;   
        }
        else
        {
            if($this->getDeveloper($id))
            {
                $this->tableGWay->update($data,array('id'=>$id));
            }
            else
            {
                throw new \Exception('Developer does not exist');
            }
        }
	}
    
    public function delDeveloper($id)
    {
        $this->tableGWay->delete(array('id' => (int)$id));
    }
    
    public function fetchtemplate(){
        $resultSet = $this->tableGWay->select(array('devId' => $devId));
       $row = $rowset->current();
    }
    
     public function fetchEmail($id)
   {
     $id = (int) $id;
        
        $rowset = $this->tableGWay->select(array('id' => $id));        
        
        $arr=array();
        foreach($rowset as $rset){
            $arr[]=array( 
            "eId"=>$rset->eId,
            
            );
        }
     return $arr;

    
   } 
    
 public function fetchAll(){
        $resultSet = $this->tableGWay->select();
        return $resultSet;
    }

}
?>