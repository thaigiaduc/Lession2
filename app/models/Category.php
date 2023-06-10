<?php



class Category extends Model
{
    private $tables = 'categories';

    function tableFill()
    {
        return $this->tables;
    }

    public function fieldFill()
    {
        return 'id, category_name, parent_id';
    }

    public function search()
    {
        //
    }

    public function sort()
    {
        //
    }

    public function filter()
    {
        //
    }
}
