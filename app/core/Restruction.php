<?php
/**
 * Created by PhpStorm.
 * User: seeynii.faay
 * Date: 10/4/19
 * Time: 1:08 PM
 */

namespace app\core;

use Jacwright\RestServer\RestException;

class Restruction
{

    /**
     * @throws \Jacwright\RestServer\RestException
     */
    protected function addDroitControllers() {
        try {
            Session::setAttribut("total", 0);
            Session::setAttribut("nbr", 0);
            $controllers = $this->getControllers();
            foreach ($controllers as $oneCont) $this->addDroitController($oneCont);
            if(intval(Session::getAttribut("nbr")) > 0) Utils::setMessageALert(["success","configuration des droits ".Session::getAttribut("nbr")."/".Session::getAttribut("total")." ajouté(s)"]);
            Session::destroyAttributSession("total");
            Session::destroyAttributSession("nbr");
        } catch (\ReflectionException $ex) {
            Utils::setMessageError(['000',$ex->getMessage()]);
            Utils::redirect("error", "error", [], "default");
            exit();
        } catch (RestException $ex) {
            Utils::setMessageError(['000',$ex->getMessage()]);
            Utils::redirect("error", "error", [], "default");
            exit();
        }
    }

    /**
     * @param $classe
     * @throws \ReflectionException
     * @throws \Jacwright\RestServer\RestException
     */
    private function addDroitController($classe) {
        $model = new Model();
        $classe = SPACE === "default" ? 'app\controllers\\'.$classe.'Controller' : 'app\controllers\\'.SPACE.'\\'.$classe.'Controller';
        $reflection = new \ReflectionClass($classe);
        $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
        $methods = array_map(function ($item){return  in_array($item->name, ['__construct', 'authorized', 'setParamGET', 'setParamPOST', 'setParamFILE']) || Utils::endsWith($item->name, '__') || Utils::endsWith($item->name, 'Processing') || Utils::endsWith($item->name, 'Modal') ? '' : $item;},$methods);
        $methods = @Utils::setPurgeArray($methods);

        foreach ($methods as $oneMethod) {
            $action = $oneMethod->name;
            $controller = $oneMethod->class;
            $controller = str_replace('Controller', '', $controller);
            $controller = (SPACE === "default") ? str_replace('app\controllers\\', '', $controller) : str_replace('app\controllers\\'.SPACE.'\\', '', $controller);
            $doc = $oneMethod->getDocComment();
            if($doc != false) {
                $droit = explode("@droit", $doc);
                $droit = (isset($droit[1])) ? $droit[1] : null;
                if(!is_null($droit)) {
                    Session::setAttribut("total", (intval(Session::getAttribut("total"))+1));
                    if(count($model->get(["table"=>"droit", "champs"=>["id"], "condition"=>["espace ="=>SPACE, "UPPER(controller) ="=>strtoupper($controller),"UPPER(action) ="=>strtoupper($action)]])) === 0){
                        $droit = trim(preg_replace("#\n|\t|\r|\*/|\*#", "",$droit));
                        $droit = explode("-", $droit);
                        $droit[1] = $model->get(["table"=>"sous_module", "champs"=>["id"], "condition"=>["UPPER(code) ="=>strtoupper(trim($droit[1]))]]);
                        $droit[1] = (isset($droit[1][0]->id)) ? $droit[1][0]->id : 0;
                        if(intval($droit[1]) > 0) {
                            $param = [
                                "libelle" => trim($droit[0]),
                                "sous_module_id" => $droit[1],
                                "controller" => $controller,
                                "action" => $action
                            ];
                            if(!is_null(SPACE)) $param['espace'] = SPACE;
                            $param = array_map(function ($one){return trim($one);}, $param);
                            $rst = $model->set(["table"=>"droit", "champs"=>$param]);
                            if($rst !== false) Session::setAttribut("nbr", (intval(Session::getAttribut("nbr"))+1));
                        }
                    }
                }
            }
        }
    }

    /**
     * @return array
     */
    private function getControllers() {
        $controllers = SPACE === "default" ? scandir(ROOT.'app/controllers/') : scandir(ROOT.'app/controllers/'.SPACE);
        $controllers = array_map(function ($item){return Utils::startsWith($item,'.') || Utils::startsWith($item,'Webservice') || Utils::startsWith($item,'Error') || Utils::startsWith($item,'Language') || Utils::startsWith($item,'Config') || !Utils::endsWith($item,'.php') ? '' : str_replace("Controller.php", "", $item);},$controllers);
        return @Utils::setPurgeArray($controllers);
    }

    /**
     * @throws \Jacwright\RestServer\RestException
     */
    protected function addDroitServices() {
        try {
            $microServices = $this->getMicroServices();
            $model = new Model();
            $total = 0;
            $dothis = 0;
            foreach ($microServices as $api => $microServicesApi)
                foreach ($microServicesApi as $microService)
                    $dothis += $this->addDroitService($model, $api, $microService, $total);
            return $this->response(['code'=>200, 'error'=>false, 'msg'=>"configuration des droits $dothis/$total ajouté(s)"]);
        } catch (\ReflectionException $ex) {
            return $this->response(['code'=>500, 'error'=>true, 'msg'=>$ex->getMessage()]);
        } catch (RestException $ex) {
            return $this->response(['code'=>500, 'error'=>true, 'msg'=>$ex->getMessage()]);
        }
    }

    /**
     * @param $model
     * @param $api
     * @param $microService
     * @param $total
     * @return int
     * @throws \ReflectionException
     */
    private function addDroitService($model, $api, $microService, &$total) {
        $dothis = 0;
        $microService = "app\webservice\\$api\\$microService";
        $reflection = new \ReflectionClass($microService);
        $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
        $methods = array_map(function ($item){return  in_array($item->name, ['__construct', 'authorize', 'getServer', 'deleteCash', 'setParamGET', 'setParamPOST', 'setParamFILE', 'setUrl', 'setLang', 'setPatch', 'setApi', 'setApiServer']) || Utils::endsWith($item->name, '__') || Utils::endsWith($item->name, 'Processing') || Utils::endsWith($item->name, 'Modal') ? '' : $item;},$methods);
        $methods = Utils::setPurgeArray($methods);
        foreach ($methods as $oneMethod) {
            $action = null;
            $droit = null;
            $microService = str_replace("app\webservice\\$api\\", '', $oneMethod->class);
            $doc = $oneMethod->getDocComment();
            if($doc != false) {
                $pattern = "#(@[a-zA-Z]+\s*[a-zA-Z0-9].*)#";
                preg_match_all($pattern, $doc, $droits, PREG_PATTERN_ORDER);
                foreach ($droits[0] as $item) {
                    if(Utils::startsWith($item, '@url')) $action = explode("@url", $item)[1];
                    elseif(Utils::startsWith($item, '@droit')) $droit = trim(str_replace("@droit", "", $item));
                }
                $action = str_replace(" ", "", trim($action));
                if(!is_null($droit)) {
                    $total++;
                    $rst = $model->get(["table"=>"droit", "champs"=>["id"], "condition"=>["espace ="=>$api, "UPPER(controller) ="=>strtoupper($microService),"UPPER(action) ="=>strtoupper($action)]]);
                    if($rst['code'] == 200 && count($rst['data']) === 0){
                        $droit = explode("-", $droit);
                        $param = ["table"=>"sous_module sm", "champs"=>["sm.id"], "jointure"=>["INNER JOIN module m ON sm.module_id = m.id"], "condition"=>["UPPER(sm.code) ="=>strtoupper(trim($droit[1]))]];
                        $droit[1] = $model->get($param)['data'];
                        $droit[1] = (isset($droit[1][0]->id)) ? $droit[1][0]->id : 0;
                        if(intval($droit[1]) > 0) {
                            $param = [
                                "libelle" => trim($droit[0]),
                                "sous_module_id" => $droit[1],
                                "espace" => $api,
                                "controller" => $microService,
                                "action" => $action
                            ];
                            $param = array_map(function ($one){return trim($one);}, $param);
                            $rst = $model->set(["table"=>"droit", "champs"=>$param]);
                            if((int)$rst['data'][0] > 0) $dothis++;
                        }
                    }
                }
            }
        }
        return $dothis;
    }

    /**
     * @return array
     */
    private function getMicroServices() {
        $tab = [];
        $services = Utils::getContentDir(ROOT.'app/webservice/');
        foreach ($services as $item) {
            if(is_dir(ROOT . "app/webservice/$item")) {
                $temp = Utils::getContentDir(ROOT . "app/webservice/$item");
                foreach ($temp as $item2)
                    if(is_file(ROOT . "app/webservice/$item/$item2"))
                        $tab[$item][] = strtolower(str_replace(".php", "", $item2));
            }
        }
        return $tab;
    }

    use Response;
}