<?php
namespace Controller;

use Model\Model;
use View\View;

class Controller{
    //ATTRIBUT
    private Model $model;
    private View $view;

    //CONSTRUCTOR
    public function __construct(Model $model, View $view){
        $this->model = $model;
        $this->view = $view;
    }

    //GETTER ET SETTER
    public function getModel():Model{
        return $this->model;
    }

    public function setModel(Model $newModel):self{
        $this->model = $newModel;
        return $this;
    }

    public function getView():View{
        return $this->view;
    }

    public function setView(View $newView):self{
        $this->view = $newView;
        return $this;
    }

    //METHODS
    public function render():void{
        //1. Appel du model pour récupérer les données
        $data = $this->model->findAll();

        //2. Passage des data à la View et son appel pour afficher les data
        $this->view->setData($data)->displayAll();
    }
}
