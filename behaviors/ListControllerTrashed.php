<?php namespace Djetson\Store\Behaviors;

use Flash;
use Backend\Classes\ControllerBehavior;

/**
 * Class ListControllerTrashed
 * @property \Backend\Classes\Controller|\Backend\Behaviors\ListController $controller
 */
class ListControllerTrashed extends ControllerBehavior
{
    public function trashed()
    {
        $this->controller->asExtension('ListController')->index();
    }

    public function trashed_onRestore()
    {
        if (($records = $this->getCheckedModels()) && $records->count())
        {
            /** @var object $record */
            foreach ($records as $record)
            {
                $record->restore();
            }
            Flash::success(trans('djetson.store::lang.list.restore_selected_success'));
        }
        else {
            Flash::error(trans('djetson.store::lang.list.restore_selected_empty'));
        }

        return $this->controller->listRefresh('trashed');
    }

    public function trashed_onForceDelete()
    {
        if (($records = $this->getCheckedModels()) && $records->count())
        {
            /** @var object $record */
            foreach ($records as $record)
            {
                $record->forceDelete();
            }
            Flash::success(trans('djetson.store::lang.list.force_delete_selected_success'));
        }
        else {
            Flash::error(trans('djetson.store::lang.list.force_delete_selected_empty'));
        }

        return $this->controller->listRefresh('trashed');
    }

    /**
     * @param $query object
     * @param $definition
     */
    public function listExtendQuery($query, $definition)
    {
        if ($definition == 'trashed') {
            $query->onlyTrashed();
        }
    }

    /**
     * @return object
     * @throws \ApplicationException
     */
    private function getCheckedModels()
    {
        try {
            $config = $this->controller->listGetConfig('trashed');
            /** @var $model object */
            $model = new $config->modelClass;
            return $model->withTrashed()->whereIn($model->getKeyName(), post('checked'))->get();
        }
        catch (\Exception $ex) {
            throw new \ApplicationException($ex->getMessage());
        }
    }
}