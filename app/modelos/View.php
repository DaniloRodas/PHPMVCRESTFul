<?PHP

  class View{
    private $db;
    public function __construct(){
      $this->db = new Database;
    }

    public function usuarios(){
      $this->db->query("SELECT * FROM vv_usuarios");
      return $this->db->registros();
    }

  }



  ?>