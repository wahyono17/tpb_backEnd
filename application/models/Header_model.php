<?php 
class Header_model extends CI_Model {
    public function getHeader ($nomor_peb = null, $tahun = null, $bulan = null) 
    {
        $this->db->select('NOMOR_AJU,TANGGAL_DAFTAR,YEAR(TANGGAL_DAFTAR) as TAHUN, MONTH(TANGGAL_DAFTAR) as BULAN, NOMOR_DAFTAR,KODE_DOKUMEN_PABEAN,CIF, HARGA_PENYERAHAN');     

    if ($nomor_peb === null && $tahun === null && $bulan === null){
        $tahun = date('Y-m-d');
        return $hasil = $this->db->get_where('tpb_header',['TANGGAL_DAFTAR'=> $tahun])->result_array();
        
    } else if($nomor_peb === null && $tahun != null && $bulan === null) {
        return $this->db->get_where('tpb_header',['YEAR(TANGGAL_DAFTAR)'=> $tahun])->result_array();
        
    } else if ($nomor_peb != null && $tahun === null && $bulan === null){
        return $this->db->get_where('tpb_header',['NOMOR_DAFTAR'=> $nomor_peb])->result_array();
    
    } else if($nomor_peb != null && $tahun != null && $bulan === null){
        $multiwhere = ['NOMOR_DAFTAR' => $nomor_peb, 'YEAR(TANGGAL_DAFTAR)' => $tahun];
        return $this->db->get_where('tpb_header',$multiwhere)->result_array();
    
    } else if($nomor_peb === null && $tahun != null && $bulan != null){
        $multiwhere = ['YEAR(TANGGAL_DAFTAR)' => $tahun, 'MONTH(TANGGAL_DAFTAR)'=> $bulan];
        return $this->db->get_where('tpb_header',$multiwhere)->result_array();
    
    }  else if ($nomor_peb != null && $tahun != null && $bulan != null){
        $multiwhere = ['NOMOR_DAFTAR' => $nomor_peb,'YEAR(TANGGAL_DAFTAR)' => $tahun, 'MONTH(TANGGAL_DAFTAR)'=> $bulan];
        return $this->db->get_where('tpb_header',$multiwhere)->result_array();
    
    }
    
    }
    
}
?>