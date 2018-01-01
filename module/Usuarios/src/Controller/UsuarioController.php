<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuarios\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Usuarios\Model\Dao\IUsuarioDao;
use RestApi\Controller\ApiController;

class UsuarioController extends ApiController
{
	private $usuarioDao;
    public function __construct(IUsuarioDao $usuarioDao)
    {
       $this->usuarioDao = $usuarioDao;
    }
    
    public function listarAction()
    {
        // your action logic

        // Set the HTTP status code. By default, it is set to 200
        $this->httpStatusCode = 200;

        // Set the response
        $data=0;
        $list = array();
        $i=0;
        foreach($this->usuarioDao->obtenerTodos() as $usuario){
          $list[$i] = array('id' => $usuario->getId() , 
                            'nombre' => $usuario->getNombre(),
                            'apellido' => $usuario->getApellido(),
                            'email' => $usuario->getEmail());
          $i++;        
        }
        $this->apiResponse['articles']=$list;
        //this->apiResponse['articles']=$usuario->getId();
        //$this->apiResponse['articles']=$this->usuarioDao->obtenerTodos();
        return $this->createResponse();
    }
}
