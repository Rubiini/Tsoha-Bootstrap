<?php

/**
 * Description of classification_controller
 *
 * @author samukaup
 */
class ClassificationController extends BaseController {

    public static function classification() {
        
        $classification = Classification::all();
        View::make('classification/class.html', array('classification' => $classification));
    }

    public static function show($id) {
        $classification = Classification::find($id);
        View::make('classification/class_show.html', array('classification' => $classification));
    }

    public static function store() {
        $params = $_POST;
        $attributes = new Classification(array('title' => $params['title']));

        $classification = new Classification($attributes);
        $errors = $classification->errors();

        
        if (count($errors) == 0) {
            $classification->save();
            Redirect::to('/classification/' . $classification->id, array('message' => 'Classification has been added to your notebook!'));
        } else {
            View::make('classification/class_new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function create() {
        View::make('classification/class_new.html');
    }

    public static function edit($id) {
        $classification = Classification::find($id);
        View::make('classification/class_edit.html', array('attributes' => $classification));
    }


    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'title' => $params['title']
        );

        $classification = new Classification($attributes);
        $errors = $classification->errors();

        if (count($errors) > 0) {
            View::make('classification/:id/class_edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $classification->update();

            Redirect::to('/classification/' . $classification->id, array('message' => 'Classification has been edited successfully!'));
        }
    }

    public static function destroy($id) {
        $classification = new Classification(array('id' => $id));
        $classification->destroy();

        Redirect::to('/classification', array('message' => 'Classification has been deleted successfully!'));
    }
}
