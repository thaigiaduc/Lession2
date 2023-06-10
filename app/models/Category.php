<?php



class Category extends Model
{
    protected $tables = 'categories';

    public function getCategoryList()
    {
        $data = $this->db->query("SELECT * from $this->tables")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
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
