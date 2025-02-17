<?php
class supplier_model extends ci_model{


    function data()
    {
        $this->db->order_by('id_supplier','ASC');
        return $query = $this->db->get('supplier');
    }

    public function ambilFoto($where)
    {
      $this->db->order_by('id_supplier','ASC');
      $this->db->limit(1);
      $query = $this->db->get_where('supplier', $where);   
      
      $data = $query->row();
      $foto= $data->foto;
      
      return $foto;
    }

    public function ambilId($table, $where)
   {
       return $this->db->get_where($table, $where);
    }

    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
         if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return false;

    }


    public function detail_data($where, $table)
    {
       return $this->db->get_where($table,$where);
    }

    public function tambah_data($data, $table)
    {
       $this->db->insert($table, $data);
    }

    public function ubah_data($where, $data, $table)
    {
       $this->db->where($where);
       $this->db->update($table, $data);

    }


    public function buat_kode()   {
		  $this->db->select('RIGHT(supplier.id_supplier,4) as kode', FALSE);
		  $this->db->order_by('id_supplier','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('supplier');      //cek dulu apakah ada sudah ada kode di tabel.
		  if($query->num_rows() <> 0){
		   //jika kode ternyata sudah ada.
		   $data = $query->row();
		   $kode = intval($data->kode) + 1;
		  }
		  else {
		   //jika kode belum ada
		   $kode = 1;
		  }
		  $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		  $kodejadi = "SPLY-".$kodemax;    
		  return $kodejadi;
	}

}
