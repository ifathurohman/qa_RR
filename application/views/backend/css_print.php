<link rel="shortcut icon" href="<?= base_url('aset/img/icon.png'); ?>">
<style type="text/css">
   .full-width {
      width: 100%;
   }
   .text-right {text-align:right;}
   #header-page,#print-page,#print-page table,#print-page span,#print-page p,#print-page td,#print-page th {  
      font-family: 'rockwell';
      font-size:10pt !important; 
      color:#000 !important;
   } 

   .header { height:30px; }
   #print-header {
      width: 100%;
      display: block;
   }
   #print-header td{
      color:#000;
      font-size: 10pt !important;
   }
   
   #print-page table{border-collapse: collapse;}
   @media print {
      @page { margin: 0; }
      body { margin: 1cm; font-size: 10pt !important;}
   }
   
   #print-page table{
    margin:0px 0px !important;
   }
  .title-header {
      font-size: 15pt !important;
      font-weight: bold !important;
      text-transform: uppercase !important;
   }
   #print-page td,#print-page th { vertical-align:top; padding-left: 5px;}
   #print-page table { border-collapse: collapse; }
   #print-page #table > table { border: 1px solid black; }
   #print-page #table > thead > tr > th { border: 1px solid black; }
   #print-page #table > tbody > tr > th { border: 1px solid black; }
   #print-page #table > tbody > tr > td { border: 1px solid black; }
   #print-page #border-none table{ border: none; }
   #print-page #border-none th{ border: none; }
   #print-page #border-none td { border: none; padding: 0px 5px;}
   #print-page body, #header-page body { font-family: 'rockwell'; font-size:13; } 
   #print-page table { margin-bottom: 2em; }
   #print-page thead { background-color: #eeeeee; }
   #print-page tbody { background-color: #fff; }
   #print-page .collapse th { padding: 3pt; border:1px solid #000; }
   #print-page .collapse td { padding: 3pt; border:1px solid #000; }
   #print-page .collapse { border-collapse: collapse; }
   #print-page .td-title { padding: 10px 0px; }
   #print-page .bg-black { background: #000 !important; }
   b{color:#000 !important;}
   #print-page { font-size: 10pt !important; }
   <?php if($this->input->get("cetak") == "pdf"):?>
      #print-page #table td, #print-page #table th{border:1px solid #000 !important; border-collapse: collapse;}
      #print-page #table .no-border td{
         border:1px solid #fff !important;
      }
   <?php endif; ?>
   .tanda-tangan td {
      padding: 0px !important;
   }
   .img-header{
      width: 150px;
   }
</style>