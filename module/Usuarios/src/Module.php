<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuarios;

use Zend\Mvc\MvcEvent;
use Zend\Db\Adapter\AdapterInterface;
use Zend\serviceManager\Factory\InvocableFactory;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Usuarios\Model\Entity\Usuario;
use Usuarios\Model\Dao\IUsuarioDao;
use Usuarios\Model\Dao\UsuarioDao;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
        
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            }
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            }
            exit(0);
        }
    }

    public function getServiceConfig()
    {
        return[
             'factories'=> [
                   'UsuariosTableGateway' => function($sm){
                              $dbAdapter=$sm->get(AdapterInterface::class);
                              $resultSetPrototype = new ResultSet();
                              $resultSetPrototype->setArrayObjectPrototype(new Usuario());
                              return new TableGateway('usuarios',$dbAdapter,null,$resultSetPrototype);
                            },
                            IUsuarioDao::class => function($sm)
                            {
                                $TableGateway=$sm->get('UsuariosTableGateway');
                                $dao = new UsuarioDao($TableGateway);
                                return $dao;
                            },
             ],
        ];
    }


}
