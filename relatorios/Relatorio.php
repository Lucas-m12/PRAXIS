<?php 
require_once('relatorios/fpdf/fpdf.php');
require_once("Sql.php");
 

class Relatorio extends FPDF
   {
   var $widths;
   var $aligns;
   var $angle=0;
  
   function SetWidths($w)
   {
     //Set the array of column widths
     $this->widths=$w;
   }
  
   function SetAligns($a)
   {
     //Set the array of column alignments
     $this->aligns=$a;
   }
  
   function Row($data, string $alingn = "L")
   {
     //Calculate the height of the row
     $nb=0;
     for($i=0;$i< count($data);$i++)
         $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
     $h=5*$nb;
     //Issue a page break first if needed
     $this->CheckPageBreak($h);
     //Draw the cells of the row
     for($i=0;$i< count($data);$i++)
     {
         $w=$this->widths[$i];
         $a=isset($this->aligns[$i]) ? $this->aligns[$i] : $alingn;
         //Save the current position
         $x=$this->GetX();
         $y=$this->GetY();
         //Draw the border
         $this->Rect($x,$y,$w,$h);
         //Print the text
         $this->MultiCell($w, 5, $data[$i], 0, $a);
         //Put the position to the right of the cell
         $this->SetXY($x+$w,$y);
     }
     //Go to the next line
     $this->Ln($h);
   }
  
   function CheckPageBreak($h)
   {
     //If the height h would cause an overflow, add a new page immediately
     if($this->GetY()+$h>$this->PageBreakTrigger)
         $this->AddPage($this->CurOrientation);
   }
  
   function NbLines($w,$txt)
   {
     //Computes the number of lines a MultiCell of width w will take
     $cw=&$this->CurrentFont['cw'];
     if($w==0)
         $w=$this->w-$this->rMargin-$this->x;
     $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
     $s=str_replace("\r",'',$txt);
     $nb=strlen($s);
     if($nb>0 and $s[$nb-1]=="\n")
         $nb--;
     $sep=-1;
     $i=0;
     $j=0;
     $l=0;
     $nl=1;
     while($i<$nb)
     {
         $c=$s[$i];
         if($c=="\n")
         {
             $i++;
             $sep=-1;
             $j=$i;
             $l=0;
             $nl++;
             continue;
         }
         if($c==' ')
             $sep=$i;
         $l+=$cw[$c];
         if($l>$wmax)
         {
             if($sep==-1)
             {
                 if($i==$j)
                     $i++;
             }
             else
                 $i=$sep+1;
             $sep=-1;
             $j=$i;
             $l=0;
             $nl++;
         }
         else
             $i++;
     }
     return $nl;
   }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom - rodapé
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',6);
        // Número de páginas - rodapé
        $this->Cell(0,10,utf8_decode('Praxis Gestão Escolar  -  Página ').$this->PageNo().'/{nb}',0,0,'C');
    }

    public function Timbre($codUnidade){

        $sql = new Sql();
        $results = $sql->select("CALL fn_timbre($codUnidade)");
        return $results[0];
    }



    function Rotate($angle,$x=-1,$y=-1)
    {
        if($x==-1)
            $x=$this->x;
        if($y==-1)
            $y=$this->y;
        if($this->angle!=0)
            $this->_out('Q');
        $this->angle=$angle;
        if($angle!=0)
        {
            $angle*=M_PI/180;
            $c=cos($angle);
            $s=sin($angle);
            $cx=$x*$this->k;
            $cy=($this->h-$y)*$this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
        }
    }

    function _endpage()
    {
        if($this->angle!=0)
        {
            $this->angle=0;
            $this->_out('Q');
        }
        parent::_endpage();
    }

    function RotatedText($x,$y,$txt,$angle)
    {
        //Text rotated around its origin
        $this->Rotate($angle,$x,$y);
        $this->Text($x,$y,$txt);
        $this->Rotate(0);
    }

    function RotatedImage($file,$x,$y,$w,$h,$angle)
    {
        //Image rotated around its upper-left corner
        $this->Rotate($angle,$x,$y);
        $this->Image($file,$x,$y,$w,$h);
        $this->Rotate(0);
    }


    function formata_data_extenso($strDate)
    {
      // Array com os dia da semana em português;
      $arrDaysOfWeek = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
      // Array com os meses do ano em português;
      $arrMonthsOfYear = array(1 => 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
      // Descobre o dia da semana
      $intDayOfWeek = date('w',strtotime($strDate));
      // Descobre o dia do mês
      $intDayOfMonth = date('d',strtotime($strDate));
      // Descobre o mês
      $intMonthOfYear = date('n',strtotime($strDate));
      // Descobre o ano
      $intYear = date('Y',strtotime($strDate));
      // Formato a ser retornado
      return '  Ao(s) ' . $intDayOfMonth . ' dia(s) do mês de ' . $arrMonthsOfYear[$intMonthOfYear] . ' do ano de ' . $intYear. ',' ;
    }


}

 ?>