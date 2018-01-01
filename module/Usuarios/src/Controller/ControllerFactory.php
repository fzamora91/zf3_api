<?php
namespace Usuarios\Controller;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Usuarios\Model\Dao\IUsuarioDao;

class ControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container , $resquestedName , array $options=null)
    {
       $controller=null;
       switch ($resquestedName) 
       {
       	case UsuarioController::class :
       		$usuarioDao = $container->get(IUsuarioDao::class);
       		$controller = new UsuarioController($usuarioDao);
       		break;
       	default:
       		return(null===$options)?new $resquestedName:new $resquestedName($options);
       		
       }
       return $controller;
    }
}
