<?php

/*
 * This file is a part of tempus/tempus-webapp.
 * 
 * (c) Josh LaRosee
 *     Beau Simensen
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tempus\WebApp;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class AppControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $origApp)
    {
        $app = new SilexAppWrapper($origApp);

        $controllers = new ControllerCollection();

        $controllers->get('/', function() use ($app) {
            return $app->render('app/home.html.twig');
        });

        $controllers->get('/project/{projectId}', function($projectId) use ($app) {
            $project = $app->projectRepository()->find($projectId);

            return $project->name();
        });

        return $controllers;
    }
}
