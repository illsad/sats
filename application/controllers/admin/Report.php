<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Report extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Present_model'));
    }

    // Classes view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        $this->load->model('Students_model');

        // Apply Filter
        // Get $_GET variable
        $q = $this->input->get(NULL, TRUE);

        $data['q'] = $q;
        $params = array();
        $params['class'] = '';

        // Class
        if (isset($q['c']) && !empty($q['c']) && $q['c'] != '') {
            $params['class'] = $q['c'];
        }

        // Date start
        if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
            $params['date_start'] = $q['ds'];
        }

        // Date end
        if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
            $params['date_end'] = $q['de'];
        }

        $data['reports'] = $this->Present_model->get($params);
        $data['students'] = $this->Students_model->get(array('class' => $params['class']));
        $config['base_url'] = site_url('admin/report/index');
        $config['total_rows'] = count($this->Present_model->get());
        $this->pagination->initialize($config);

        $data['ngapp'] = 'ng-app="satsApp"';
        $data['title'] = 'Laporan Kehadiran';
        $data['main'] = 'admin/report/report_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Present_model->get(array('id' => $id)) == NULL) {
            redirect('admin/report');
        }
        $data['report'] = $this->Present_model->get(array('id' => $id));
        $data['title'] = 'Detail Kehadiran';
        $data['main'] = 'admin/report/report_view';
        $this->load->view('admin/layout', $data);
    }

    public function export_excel()
    {
        $this->load->model('Students_model');
        // Apply Filter
        // Get $_GET variable
        $q = $this->input->get(NULL, TRUE);

        $data['q'] = $q;

        $params = array();
        $class = array();
        
        // Class
        if (isset($q['c']) && !empty($q['c']) && $q['c'] != '') {
            $params['class'] = $q['c'];
            $class = $q['c'];
        }

        // Date start
        if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
            $params['date_start'] = $q['ds'];
        }

        // Date end
        if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
            $params['date_end'] = $q['de'];
        }
        
        $reports = $this->Present_model->get($params);
        $students = $this->Students_model->get($class);

        $this->load->library("PHPExcel");
        $objXLS   = new PHPExcel();
        $objSheet = $objXLS->setActiveSheetIndex(0);            
        $cell     = 2;        
        $no       = 1;

        $objSheet->setCellValue('A1', 'NO');
        $objSheet->setCellValue('B1', 'NIS');
        $objSheet->setCellValue('C1', 'NAMA SISWA');
        $objSheet->setCellValue('D1', 'KELAS');
        $objSheet->setCellValue('E1', 'IZIN');
        $objSheet->setCellValue('F1', 'SAKIT');
        $objSheet->setCellValue('G1', 'ALFA');

        if(isset($q) AND count($q) > 0){
            $i = 0;
            $s = 0;
            $a = 0;
            foreach ($students as $key):
              foreach ($reports as $row): 
                if($key['student_id'] == $row['students_student_id']){
                  switch ($row['present_type']) {
                    case 'Izin':
                    $i++;
                    break;

                    case 'Sakit':
                    $s++;
                    break;

                    case 'Alfa':
                    $a++;
                    break;
                }
            }
            endforeach;

            $objSheet->setCellValue('A'.$cell, $no);
            $objSheet->setCellValueExplicit('B'.$cell, $key['student_nis'],PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValue('C'.$cell, $key['student_full_name']);
            $objSheet->setCellValue('D'.$cell, $key['class_level'].' '.$key['class_name']);
            $objSheet->setCellValue('E'.$cell, $i); 
            $objSheet->setCellValue('F'.$cell, $s); 
            $objSheet->setCellValue('G'.$cell, $a); 

            $i = 0;
            $s = 0;
            $a = 0;
            $cell++;
            $no++;  
            endforeach;                   

            $objXLS->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $objXLS->getActiveSheet()->getColumnDimension('B')->setWidth(11);
            $objXLS->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objXLS->getActiveSheet()->getColumnDimension('C')->setWidth(10);
            $objXLS->getActiveSheet()->getColumnDimension('E')->setWidth(5);
            $objXLS->getActiveSheet()->getColumnDimension('F')->setWidth(5);
            $objXLS->getActiveSheet()->getColumnDimension('G')->setWidth(5);

            $font = array('font' => array( 'bold' => true));
            $objXLS->getActiveSheet()
            ->getStyle('A1:G1')
            ->applyFromArray($font);

            $objXLS->setActiveSheetIndex(0);        
            $styleArray = array(
              'borders' => array(
                 'allborders' => array(
                     'style' => PHPExcel_Style_Border::BORDER_THIN,
                     'color' => array(
                      'rgb'  => '111111' 
                      ),
                     ),
                 ),
              );
            $objXLS->getActiveSheet()
            ->getStyle('A1:G1')
            ->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB('00bbff');
            $objSheet->getStyle('A1:G'.$no)->applyFromArray($styleArray);
            $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5'); 
            header('Content-Type: application/vnd.ms-excel'); 
            header('Content-Disposition: attachment;filename="LAPORAN_ABSEN.xls"'); 
            header('Cache-Control: max-age=0'); 
            $objWriter->save('php://output'); 
            exit();      
        }
    }
}

/* End of file report.php */
/* Location: ./application/controllers/admin/report.php */
