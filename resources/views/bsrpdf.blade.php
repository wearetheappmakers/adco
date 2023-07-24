  <!DOCTYPE html>
  <html>
  <head>
  	<style type="text/css">
  		body{
  			/*font-size: 0px !important;*/
  			font-family: "verdana", sans-serif;
  			font-size: 8px !important;
  		}
  		td,th{
  			font-family: "verdana", sans-serif;
  			font-size: 7px !important;
  			border-collapse: collapse;
  			border: 1px solid #737373 !important;
  			padding: 2px !important; 
  		}
  		.no-break {
  			page-break-before: always !important;
  		}
  		ol li{
  			text-align: justify;
  			font-size:70% !important;
  		}

  		{
  			box-sizing: border-box;
  		}

  		.row {
  			margin-left:-5px;
  			margin-right:-5px;
  		}

  		.column {
  			float: left;
  			width: 25%;
  			/*padding: 5px;*/
  		}

  		.column1 {
  			float: left;
  			width: 50%;
  			/*padding: 5px;*/
  		}

  		.column2 {
  			/*float: left;*/
  			width: 100%;
  			/*padding: 5px;*/
  		}

  		.column3 {
  			float: left;
  			width: 50%;
  			/*padding: 5px;*/
  		}

        .column4 {
            float: left;
            width: 60%;
            /*padding: 5px;*/
        }

        .column5 {
            float: right;
            width: 40%;
            /*padding: 5px;*/
        }

        .column6 {
            float: left;
            width: 50%;
            /*padding: 5px;*/
        }

        .column7 {
            float: right;
            width: 50%;
            /*padding: 5px;*/
        }



        input[type="checkbox"] {
            font-size: 12px !important;
            margin-top:  -3px;
            margin-bottom:  -5px;
        }

        



        table {
         border-collapse: collapse;
         border-spacing: 0;
         width: 100%;
         border: 1px;
     }

     th, td {
         text-align: left;
         padding: 16px;
     }
 </style>
 <title>ADCO</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head> 

<?php $data = App\Bsr::where('so_id',request()->id)->first();
$customer = App\Customer::where('id',$data->customer_id)->value('name');

?>

<div class="row">
   <div class="column">
    <table>
     <tr>
      <th>
       <center><img src="{{asset('assets/media/logos/amaronlogo.jpg')}}" width="175" height="46"></center>
   </th>
</tr>
</table>
</div>
<div class="column1">
    <table >
     <tr>
      <th style="font-size: 12px !important;">
       <center><b>
        BATTERY SERVICE REPORT
    </b></center>
</th>
</tr>
<tr>
  <th style="font-size: 8px !important; border-bottom: none !important;">
   <center><b>
    AMRITLAL DESAI & COMPANY
</b></center>
</th>
</tr>
<tr>
  <td style="font-size: 6px !important; border-top: none !important;">
   <center>
    ADCOMPLEX, STATION ROAD, NEAR HOTEL PRINCE, BHUJ,9825025460
</center>
</td>
</tr>
</table>
</div>
<div class="column">
    <table>
     <tr>
      <th height="1.3%" style="border-bottom: none !important;"></th>
  </tr>
  <tr>
      <th style="border-top: none !important;">
       No : {{$data->no}}
   </th>
   <tr>
      <td style="font-size: 10px !important;">
       *Please tick <input type="checkbox" checked="checked"> the appropriate box
   </td>		
</tr>
</tr>
</table>
</div>
</div>

<div class="row">
   <div class="column2">
    <table>
     <tr>
      <td width="50%"><b>SCF No. & Date: {{$data->scf_no}} & {{ date('d-m-Y',strtotime($data->scf_date))}}</b></td>
      <td><b>Complaint Reported Date: {{ date('d-m-Y',strtotime($data->complaint_date)) }} </b></td>
  </tr>

  <tr>
      <td width="50%">1. Customer Name: {{$customer}}</td>
      <td>
       9. Segment:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

       @if($data->segment1 == 1)
       <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; OEM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       @else
       <input type="checkbox" name="segment1" value="1" class="form_0006_fld_2-0 formFieldLabel">
       OEM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       @endif

       @if($data->segment2 == 2) 
       <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Afetr Market &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       @else 
       <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel" name="segment1" value="2" >Afetr Market  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       @endif

       @if($data->segment3 == 3)
       <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Institutional 
       @else  
       <input type="checkbox" name="segment1" value="3" class="form_0006_fld_2-0 formFieldLabel">
       Institutional
       @endif
   </td>
</tr>

<tr>
  <td width="50%"> 2. Mobile No: {{$data->mobile_no}}</td>
  <td>
   10. Battery Type:&nbsp;&nbsp;&nbsp;

   @if($data->bettery_type1 == 1)
    <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Two Wheeler &nbsp;&nbsp;&nbsp;
    @else 
   <input type="checkbox" name="bettery_type1" value="1" class="form_0006_fld_2-0 formFieldLabel">
   Two Wheeler &nbsp;&nbsp;&nbsp;
   @endif

   @if($data->bettery_type2 == 2)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp;  Automotive &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    @else 
   <input type="checkbox" name="bettery_type2" value="2" class="form_0006_fld_2-0 formFieldLabel">
   Automotive &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   @endif

   @if($data->bettery_type3 == 3)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Tubular
    @else
   <input type="checkbox" name="bettery_type3" value="3" class="form_0006_fld_2-0 formFieldLabel">
   Tubular
   @endif
</td>
</tr>

<tr>
  <td width="50%" rowspan="2">
   3. Address:{{$data->address}}
</td>
<td>
   11. Part No.:{{$data->part_no}}
</td>
</tr>

<tr>
  <td>
   12. Warranty: &nbsp;&nbsp;&nbsp;&nbsp; FR &nbsp;{{$data->warranty}}&nbsp; + PR &nbsp;{{$data->warranty1}}&nbsp; Months  
</td>
</tr>

<tr>
  <td width="50%">
   4. Call Source: &nbsp;&nbsp;&nbsp;

   @if($data->call_source1 == 1)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Customer &nbsp;&nbsp;
    @else
   <input type="checkbox" name="call_source1" value="1" class="form_0006_fld_2-0 formFieldLabel">
   Customer &nbsp;&nbsp;
   @endif

   @if($data->call_source2 == 2)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Dealer &nbsp;&nbsp;
    @else
   <input type="checkbox" name="call_source2" value="2" class="form_0006_fld_2-0 formFieldLabel">
   Dealer &nbsp;&nbsp;
   @endif

   @if($data->call_source3 == 3)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; OED &nbsp;&nbsp;
    @else
   <input type="checkbox" name="call_source3" value="3" class="form_0006_fld_2-0 formFieldLabel">
   OED &nbsp;&nbsp;
   @endif

   @if($data->call_source4 == 4)
    <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Call Center &nbsp;&nbsp;
    @else
   <input type="checkbox" name="call_source4" value="4" class="form_0006_fld_2-0 formFieldLabel">
   Call Center &nbsp;&nbsp;
   @endif

   @if($data->call_source5 == 5)
    <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; ARBL
    @else
   <input type="checkbox" name="call_source5" value="5" class="form_0006_fld_2-0 formFieldLabel">
   ARBL
   @endif
</td>
<td>
   13. Batt.Sl.No.:{{$data->batt_si_no}}
</td>
</tr>

<tr>
  <td width="50%">
   5. Dealer Name: {{$data->dealer_name}}
</td>
<td>
   14. Date of Sale: {{ date('d-m-Y',strtotime($data->date_of_sale)) }}
   15. Mfg. M/Y: {{ date('d-m-Y',strtotime($data->mfg_date)) }}
</td>
</tr>

<tr>
  <td width="50%">
   6. Location:{{$data->location}}
</td>
<td>
   16. TSF/WR No. & Date:{{$data->tsf_no}} / {{ date('d-m-Y',strtotime($data->tsf_date)) }}
</td>
</tr>

<tr>
  <td width="50%">
   7. Type of Service Call: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   @if($data->service_call1 == 1)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; First Time &nbsp;&nbsp;&nbsp;&nbsp;
    @else
   <input type="checkbox" name="service_call1" value="1" class="form_0006_fld_2-0 formFieldLabel">
   First Time &nbsp;&nbsp;&nbsp;&nbsp;
   @endif

   @if($data->service_call2 == 2)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Repeated
    @else
   <input type="checkbox" name="service_call2" value="2"  class="form_0006_fld_2-0 formFieldLabel">
   Repeated
   @endif
</td>
<td>
   17. TSF/WR Created By: &nbsp;&nbsp;&nbsp;

   @if($data->tsf_created_by1 == 1)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Dealer &nbsp;&nbsp;
    @else
   <input type="checkbox" name="tsf_created_by1" value="1" class="form_0006_fld_2-0 formFieldLabel">
   Dealer &nbsp;&nbsp;
   @endif

   @if($data->tsf_created_by2 == 2)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Franchisee &nbsp;&nbsp;
    @else
   <input type="checkbox" name="tsf_created_by2" value="2" class="form_0006_fld_2-0 formFieldLabel">
   Franchisee &nbsp;&nbsp;
   @endif

   @if($data->tsf_created_by3 == 3)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Customer &nbsp;&nbsp;
    @else
   <input type="checkbox" name="tsf_created_by3" value="3" class="form_0006_fld_2-0 formFieldLabel">
   Customer &nbsp;&nbsp;
   @endif 

   @if($data->tsf_created_by4 == 4)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; ARBL
    @else
   <input type="checkbox" name="tsf_created_by4" value="4" class="form_0006_fld_2-0 formFieldLabel">
   ARBL
   @endif 
</td>
</tr>

<tr>
  <td width="50%">
   8. Date of Previous Replacement (if any):{{ date('d-m-Y',strtotime($data->replace_date))}}
</td>
<td>
   18. Lead Time: {{$data->lead_time}} M &nbsp;
   19. Warranty Status: &nbsp; 

   @if($data->warranty_status1 == 1)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; FR &nbsp;&nbsp;
    @else
   <input type="checkbox" name="warranty_status1" value="1" class="form_0006_fld_2-0 formFieldLabel">
   FR &nbsp;&nbsp;
   @endif 

   @if($data->warranty_status2 == 2)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; PR &nbsp;&nbsp;
    @else
   <input type="checkbox" name="warranty_status2" value="2" class="form_0006_fld_2-0 formFieldLabel">
   PR &nbsp;&nbsp;
   @endif

   @if($data->warranty_status3 == 3)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; USD &nbsp;&nbsp;
    @else
   <input type="checkbox" name="warranty_status3" value="3" class="form_0006_fld_2-0 formFieldLabel">
   USD &nbsp;&nbsp;
   @endif

   @if($data->warranty_status4 == 4)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; OW &nbsp;&nbsp;
    @else
   <input type="checkbox" name="warranty_status4" value="4" class="form_0006_fld_2-0 formFieldLabel">
   OW &nbsp;&nbsp;
   @endif
</td>
</tr>

<tr>
  <td width="50%">
   <b>20. Nature of Problem : {{$data->nature_problem}}</b>
</td>
<td>
   21. OCV: {{$data->ocv}}&nbsp; V &nbsp;&nbsp;&nbsp;
   22. Standby Provided: &nbsp;

   @if($data->standby_provided1 == 1)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Yes &nbsp;&nbsp;
    @else
   <input type="checkbox" name="standby_provided1" value="1" class="form_0006_fld_2-0 formFieldLabel">
   Yes &nbsp;&nbsp;
   @endif

   @if($data->standby_provided2 == 2)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; No &nbsp;&nbsp;
    @else
   <input type="checkbox" name="standby_provided2" value="2" class="form_0006_fld_2-0 formFieldLabel">
   No &nbsp;&nbsp;
   @endif
</td>
</tr>

<tr>
  <td width="50%" style="border-right:none !important">
   23. Physical Condition of Battery (on Receipt): &nbsp;&nbsp;&nbsp;

   @if($data->physical_condition1 == 1)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Good &nbsp;&nbsp;&nbsp;&nbsp;
    @else
   <input type="checkbox" name="physical_condition1" value="1" class="form_0006_fld_2-0 formFieldLabel">
   Good &nbsp;&nbsp;&nbsp;&nbsp;
   @endif

   @if($data->physical_condition2 == 2)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Damage
    @else
   <input type="checkbox" name="physical_condition2" value="2" class="form_0006_fld_2-0 formFieldLabel">
   Damage
   @endif
</td>
<td style="border-left:none !important">
   Specify damages, if any:.........................................................................................
</td>
</tr>

<tr>
  <td width="50%" style="border-right:none !important">
   <b>24. Attended Place:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

   @if($data->attended_place1 == 1)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Franchisee &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    @else
   <input type="checkbox" name="attended_place1" value="1" class="form_0006_fld_2-0 formFieldLabel">
   Franchisee &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   @endif

   @if($data->attended_place2 == 2)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; S-HUB &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    @else
   <input type="checkbox" name="attended_place2" value="2" class="form_0006_fld_2-0 formFieldLabel">
   S-HUB &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   @endif

   @if($data->attended_place3 == 3)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Dealer
    @else
   <input type="checkbox" name="attended_place3" value="3" class="form_0006_fld_2-0 formFieldLabel">
   Dealer 
   @endif
</td>
<td style="border-left:none !important">

    @if($data->attended_place4 == 4)
    <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; OED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    @else
   <input type="checkbox" name="attended_place4" value="4" class="form_0006_fld_2-0 formFieldLabel">
   OED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   @endif

   @if($data->attended_place5 == 5)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Road Side Assistance &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   @else
   <input type="checkbox" name="attended_place5" value="5" class="form_0006_fld_2-0 formFieldLabel">
   Road Side Assistance &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   @endif

   @if($data->attended_place6 == 6) 
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Door Step Service &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   @else
   <input type="checkbox" name="attended_place6" value="6" class="form_0006_fld_2-0 formFieldLabel">
   Door Step Service &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   @endif
</td>
</tr>

<tr>
  <td colspan="2">
   <b>25. Proof of Warranty:</b> &nbsp;&nbsp;

   @if($data->proof_of_warranty1 == 1)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Warranty Card &nbsp;&nbsp;
   @else
   <input type="checkbox" name="proof_of_warranty1" value="1" class="form_0006_fld_2-0 formFieldLabel">
   Warranty Card &nbsp;&nbsp;
   @endif

   @if($data->proof_of_warranty2 == 2)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; TSF-ACS &nbsp;&nbsp;
   @else
   <input type="checkbox" name="proof_of_warranty2" value="2" class="form_0006_fld_2-0 formFieldLabel">
   TSF-ACS &nbsp;&nbsp;
   @endif

   @if($data->proof_of_warranty3 == 3) 
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; WR-DSM &nbsp;&nbsp;
   @else
   <input type="checkbox" name="proof_of_warranty3" value="3" class="form_0006_fld_2-0 formFieldLabel">
   WR-DSM &nbsp;&nbsp;
   @endif

   @if($data->proof_of_warranty4 == 4)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Franchisee Invoice &nbsp;&nbsp;
   @else
   <input type="checkbox" name="proof_of_warranty4" value="4" class="form_0006_fld_2-0 formFieldLabel">
   Franchisee Invoice &nbsp;&nbsp;
   @endif

   @if($data->proof_of_warranty5 == 5)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Dealer's Invoice &nbsp;&nbsp;
   @else
   <input type="checkbox" name="proof_of_warranty5" value="5" class="form_0006_fld_2-0 formFieldLabel">
   Dealer's Invoice &nbsp;&nbsp;
   @endif

   @if($data->proof_of_warranty6 == 6)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; OED Claim Form &nbsp;&nbsp;
   @else
   <input type="checkbox" name="proof_of_warranty6" value="6" class="form_0006_fld_2-0 formFieldLabel">
   OED Claim Form &nbsp;&nbsp;
   @endif

   @if($data->proof_of_warranty7 == 7) 
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Veh.Inv/insu./RC
   @else
   <input type="checkbox" name="proof_of_warranty7" value="7" class="form_0006_fld_2-0 formFieldLabel">
   Veh.Inv/insu./RC
   @endif
</td>
</tr>

<tr>
  <td colspan="2">
   <b>26. Application:</b>

   @if($data->application1 == 1)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Scooter &nbsp;&nbsp;
   @else
   <input type="checkbox" name="application1" value="1" class="form_0006_fld_2-0 formFieldLabel">
   Scooter &nbsp;&nbsp;
   @endif

   @if($data->application2 == 2)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Motorbike &nbsp;&nbsp;
   @else
   <input type="checkbox" name="application2" value="2" class="form_0006_fld_2-0 formFieldLabel">
   Motorbike &nbsp;&nbsp;
   @endif

   @if($data->application3 == 3)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Car &nbsp;&nbsp;
   @else
   <input type="checkbox" name="application3" value="3"  class="form_0006_fld_2-0 formFieldLabel">
   Car &nbsp;&nbsp;
   @endif

   @if($data->application4 == 4)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; SUV/MUV/MPV &nbsp;&nbsp;
   @else
   <input type="checkbox" name="application4" value="4" class="form_0006_fld_2-0 formFieldLabel">
   SUV/MUV/MPV &nbsp;&nbsp;
   @endif

   @if($data->application5 == 5)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; LCV/HCV/BUS &nbsp;&nbsp;
   @else
   <input type="checkbox" name="application5" value="5" class="form_0006_fld_2-0 formFieldLabel">
   LCV/HCV/BUS &nbsp;&nbsp;
   @endif

   @if($data->application6 == 6)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Tractor &nbsp;&nbsp;
   @else
   <input type="checkbox" name="application6" value="6" class="form_0006_fld_2-0 formFieldLabel">
   Tractor &nbsp;&nbsp;
   @endif

   @if($data->application7 == 7)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; SPV &nbsp;&nbsp;
   @else
   <input type="checkbox" name="application7" value="7" class="form_0006_fld_2-0 formFieldLabel">
   SPV &nbsp;&nbsp; 
   @endif

   @if($data->application8 == 8)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Genset &nbsp;&nbsp;
   @else
   <input type="checkbox" name="application8" value="8" class="form_0006_fld_2-0 formFieldLabel">
   Genset &nbsp;&nbsp;
   @endif

   @if($data->application9 == 9)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Home UPS &nbsp;&nbsp;
   @else
   <input type="checkbox" name="application9" value="9" class="form_0006_fld_2-0 formFieldLabel">
   Home UPS &nbsp;&nbsp;
   @endif

   @if($data->application10 == 10)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; E-Rickshaw &nbsp;&nbsp;
   @else
   <input type="checkbox" name="application10" value="10" class="form_0006_fld_2-0 formFieldLabel">
   E-Rickshaw &nbsp;&nbsp;
   @endif
</td>
</tr>

<tr>
  <td colspan="2">
   <b>a.</b> Make: {{$data->make}}
   <b>b.</b> Model/Capacity: {{$data->model_capacity}};
   <b>c.</b> Fuel Type: &nbsp;

   @if($data->fuel_type1 == 1) 
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Petrol &nbsp;&nbsp;
   @else
   <input type="checkbox" name="fuel_type1" value="1" class="form_0006_fld_2-0 formFieldLabel">
   Petrol &nbsp;&nbsp;
   @endif

   @if($data->fuel_type2 == 2)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Diesel &nbsp;&nbsp;
   @else
   <input type="checkbox" name="fuel_type2" value="2" class="form_0006_fld_2-0 formFieldLabel">
   Diesel &nbsp;&nbsp;
   @endif

   @if($data->fuel_type3 == 3)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; CNG &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   @else
   <input type="checkbox" name="fuel_type3" value="3" class="form_0006_fld_2-0 formFieldLabel">
   CNG &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   @endif

   <b>d.</b> Veh. Mfg.: {{$data->veh_mfg}}

</td>
</tr>

<tr>
  <td colspan="2">
   <b>e.</b> Usage: &nbsp;&nbsp;&nbsp;

   @if($data->usage1 == 1)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Personal &nbsp;&nbsp;&nbsp;&nbsp;
   @else
   <input type="checkbox" name="usage1" value="1" class="form_0006_fld_2-0 formFieldLabel">
   Personal &nbsp;&nbsp;&nbsp;&nbsp;
   @endif

   @if($data->usage2 == 2)
   <img src="{{asset('assets/media/logos/tickmark.jpg')}}" style="height:10px; width:10px;margin-top:3px"> &nbsp; Commercial &nbsp;&nbsp;&nbsp;&nbsp;
   @else
   <input type="checkbox" name="usage2" value="2" class="form_0006_fld_2-0 formFieldLabel">
   Commercial &nbsp;&nbsp;&nbsp;&nbsp;
   @endif

   <b>f.</b> Vehicle Reg. No.: {{$data->vehicle_no}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

   <b>g.</b> KMS Used:{{$data->kms_used}}

</td>
</tr>

<tr>
  <td width="50%" style="border-right:none !important">
   <b>27. Testing Observations:</b>
</td>
<td style="text-align:right !important; border-left:none !important">
   *Please follow the company guidelines for Battery changing & testing
</td>
</tr>
</table>
</div>
</div>

<div class="row">
   <div class="column1">
    <table>
     <tr>
      <td bgcolor= "gray" style="border-bottom:none !important; color: white"><b><center>Date</center></b></td>
      <td bgcolor= "gray" style="border-bottom:none !important; color: white"><b><center>Time</center></b></td>
      <td bgcolor= "gray" style="border-bottom:none !important; color: white"><b><center>Details</center></b></td>
      <td bgcolor= "gray" style="border-bottom:none !important; color: white"><b><center>Battery</center></b></td>
  </tr>
  <tr>
      <td bgcolor= "gray" style="border-top:none !important; color: white"></td>
      <td bgcolor= "gray" style="border-top:none !important; color: white"></td>
      <td bgcolor= "gray" style="border-top:none !important; color: white"></td>
      <td bgcolor= "gray" style="border-top:none !important; color: white"><b><center>Voltage</center></b></td>
  </tr>
  <tr>
      <td></td>
      <td></td>
      <td>On Receipt</td>
      <td></td>
  </tr>
  <tr>
      <td></td>
      <td></td>
      <td>Starting og Charge</td>
      <td></td>
  </tr>
  <tr>
      <td></td>
      <td></td>
      <td>During Full Charge</td>
      <td></td>
  </tr>
  <tr>
      <td></td>
      <td></td>
      <td>Afetr Retention (Rest)</td>
      <td></td>
  </tr>
  <tr>
      <td></td>
      <td></td>
      <td>After HRD/Backup Test</td>
      <td></td>
  </tr>
</table>
</div>

<div class="column3">
    <table>
     <tr>
      <th bgcolor= "gray" style="border-bottom:none !important; color: white" colspan="6"><center>Specific Gravity* (Cell No.1 starts from +Ve Terminal of Battery)</center></th>
  </tr>
  <tr>
      <td><center><b>1</b></center></td>
      <td><center><b>2</b></center></td>
      <td><center><b>3</b></center></td>
      <td><center><b>4</b></center></td>
      <td><center><b>5</b></center></td>
      <td><center><b>6</b></center></td>
  </tr>
  <tr>
      <td height="1.4%"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
  </tr>
  <tr>
      <td height="1.4%"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
  </tr>
  <tr>
      <td height="1.4%"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
  </tr>
  <tr>
      <td height="1.4%"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
  </tr>
  <tr>
      <td height="1.4%"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
  </tr>
</table>
</div>
</div>

<div class="row">
   <div class="column2">
    <table>
     <td width="50%" style="border-right:none !important">
      <b>28. Vehicle Electrical Test Perameters</b> &nbsp; (For 2W/Automotive Battery); 
  </td>
  <td style="text-align:right; border-left:none !important">
      *Recommended Changing Voltage: 14.0V to 14.40V
  </td>
</table>
</div>
</div>

<div class="row">
  <div class="column4">
      <table>
        <tr>
            <td style="border-right: none !important;" height="3.1%">
                Cranking Voltage: 
            </td>
            <td style="border-left: none !important;">V</td>
            <td style="border-right: none !important;" height="3.1%">
                Cranking Current:
            </td>
            <td style="border-left: none !important;">A</td>
        </tr>

        <tr>
            <td style="border-right: none !important;" height="3.1%">
                Leakage Current: 
            </td>
            <td style="border-left: none !important;">mA</td>
            <td colspan="2" height="3.1%">
                Additioal Loads, if any:
            </td>
        </tr>
    </table>
</div>

<div class="column5">
    <table>
        <tr>
            <th bgcolor= "gray" style="border-bottom:none !important; color: white"><center>Battery Voltage</center></th>
            <th bgcolor= "gray" style="border-bottom:none !important; color: white"><center>Idle</center></th>
            <th bgcolor= "gray" style="border-bottom:none !important; color: white"><center>Accelerated</center></th>
        </tr>

        <tr>
            <td>
                No Load
            </td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>
                Full Load
            </td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>
</div>

<div class="row">
    <div class="column1">
        <table>
            <tr>
                <td colspan="6"><b>29. HRD Test</b>(For 2W/Automotive Battery): <span style="float: right; font-size:7px !important">*Ensure full charge and rest before testing</span></td>
            </tr>

            <tr>
                <td>Load Current:</td>
                <td></td>
                <td>Drop Voltage:</td>
                <td></td>
                <td>No. Of Cycles:</td>
                <td></td> 
            </tr>

            <tr>
                <td bgcolor= "gray" style="border-bottom:none !important; color: white"><center><b>Result</b></center></td>
                <td bgcolor= "gray" style="border-bottom:none !important; color: white"><center><b>Action</b></center></td>
                <td bgcolor= "gray" style="border-bottom:none !important; color: white"><center><b>Guidelines</b></center></td>
                <td colspan="3" rowspan="4"></td>
            </tr>

            <tr>
                <td><input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                Green&nbsp;&nbsp;</td>
                <td><center>Ok-Return</center></td>
                <td width="30%" rowspan="3"><center>Recommended to replace when Battery voltage drop <9.8V</center></td>
                </tr>

                <tr>
                    <td><input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    Yellow&nbsp;&nbsp;</td>
                    <td><center>Recharge</center></td>
                </tr>

                <tr>
                    <td><input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    Red&nbsp;&nbsp;</td>
                    <td><center>Replace</center></td>
                </tr>
            </table>
        </div>

        <div class="column3">
            <table>
                <tr>
                    <td colspan="6"><b>30. Backup Test</b>&nbsp;&nbsp;(For Tubular Battery): <span style="float: right; font-size:7px !important">*Record once in every 30 or 15min</span></td>
                </tr>
            </table>
            <div class="column6">
                <table>
                    <tr>
                        <td>Load:</td>
                        <td width="50%"></td>
                    </tr>
                    <tr>
                        <td>Battery Discharge Current:</td>
                        <td width="50%"></td>

                    </tr>
                    <tr>
                        <td>Backup Time:</td>
                        <td width="50%"></td>
                    </tr>
                    <tr>
                        <td height="2.4%" colspan="2"><span style="float: right; font-size:7px !important">*Refer backup chart for decision</span></td>
                    </tr>
                    <tr>
                        <td height="1.4%" colspan="2"></td>
                    </tr>
                </table>
            </div>

            <div class="column7">
                <table>
                    <tr>
                        <th bgcolor= "gray" style="border-bottom:none !important; color: white"><center>Date</center></th>
                        <th bgcolor= "gray" style="border-bottom:none !important; color: white"><center>Time</center></th>
                        <th bgcolor= "gray" style="border-bottom:none !important; color: white"><center>Batt. Voltage</center></th>
                    </tr>
                    <tr>
                        <td height="1.4%"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td height="1.4%"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td height="1.4%"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td height="1.4%"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td height="1.4%"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </table>
    </div>

</div>

<div class="row">
    <div class="column2">
        <table>
            <tr>
                <td><b>31. Defect Code:</b> <span style="float: right; font-size:7px !important">(As per ATS)</span> </td>
                <td>Defect Description:</td>
            </tr>

            <tr>
                <td colspan="2">
                    <b>32. Decision:</b>
                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    Ok-Return&nbsp;&nbsp;

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    Replace&nbsp;&nbsp;

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    Reject&nbsp;&nbsp;&nbsp;&nbsp;

                    Date:
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    33. Replaced by: &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    Franchisee&nbsp;&nbsp;

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    S-HUB&nbsp;&nbsp; 

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    Dealer&nbsp;&nbsp;

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    OED&nbsp;&nbsp;&nbsp;&nbsp;

                    Repladec Part No:
                </td>
            </tr>

            <tr>
                <td>
                    34. Replaced Battery Serial Number:
                </td>
                <td>
                    DC/PR Inv. No. & Date:
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    35. Replaced Type:
                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    FR&nbsp;&nbsp;

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    PR&nbsp;&nbsp;

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    USD&nbsp;&nbsp;

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    GDW&nbsp;&nbsp;

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    FR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    Life Served: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; M &nbsp;&nbsp;&nbsp;

                    PR-D:
                </td>
            </tr>

            <tr>
                <td colspan="2" style="border-bottom:none !important;">
                    <b>36. Customer Feedback on Service:</b>

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    Exceeded Expectation&nbsp;&nbsp;

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    Met Expectation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    To Be Improved
                </td>
            </tr>

            <tr>
                <td style="border-right:none !important; border-top:none !important; border-bottom:none !important">
                    Customer Name:
                </td>
                <td style="border-left:none !important; border-top:none im !important;border-bottom:none !important">
                    FST Name:
                </td>
            </tr>

            <tr>
             <td style="border-right:none !important; border-top:none i !important">
                 Signature & Date:
             </td>
             <td style="border-left:none !important; border-top:none i !important">
                 Signature & Date:
             </td> 
         </tr>                
     </table>
 </div>
</div>

<div class="row">
    <div class="column2">
        <table>
            <tr>
                <td rowspan="8">
                    <img src="{{asset('assets/media/logos/37.jpg')}}" width="10">
                </td>
                <td width="100%">
                    A. Battery Tested: &nbsp;&nbsp;&nbsp;&nbsp;

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    Yes &nbsp;&nbsp;&nbsp;

                    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                    No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    Reason if No:
                </td>
            </tr>

            <tr>
             <td width="100%">
                B. Verified in Software: &nbsp;&nbsp;&nbsp;&nbsp;

                <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                Yes &nbsp;&nbsp;&nbsp;

                <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                Mismatch info if any:
            </td>
        </tr>

        <tr>
         <td width="100%">
            C. Type of Service call: &nbsp;&nbsp;&nbsp;&nbsp;

            <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
            First Time &nbsp;&nbsp;&nbsp;

            <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
            Repeated &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            & Reason if Reapeated:
        </td>
    </tr>

    <tr>
     <td width="100%">
        D. Enclosures: &nbsp;&nbsp;

        <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
        DB-Copy of WC/Inv.RC &nbsp;&nbsp;

        <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
        FR-DC &nbsp;&nbsp;

        <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
        Orgn.Empty WC of RB(FR) &nbsp;&nbsp;

        <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
        PR-Invoice &nbsp;&nbsp;

        <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
        TR.WC of RB(PR) &nbsp;&nbsp;

        <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
        Orgn.WC(USD) &nbsp;&nbsp;

        <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
        Spl.Approval &nbsp;&nbsp;

    </td>
</tr>

<tr>
 <td width="100%">
    E. Claim Approved: &nbsp;&nbsp;&nbsp;&nbsp;

    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
    Yes &nbsp;&nbsp;&nbsp;

    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
    No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    Reason if No:
</td>
</tr>

<tr>
 <td width="100%">
    F. Compensation Payable: &nbsp;&nbsp;

    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
    Yes &nbsp;&nbsp;&nbsp;

    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
    No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    Distance &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kms.(One Side) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    Amount: 
</td>
</tr>

<tr>
 <td width="100%">
    G. TDA Requirement: If 'Yes', then select &nbsp;&nbsp;&nbsp;&nbsp;

    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
    Marking Done &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
    BSR Mailed 
</td>
</tr>

<tr>
 <td>
     Service Engineer Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

     Signature & Date:
 </td>
</tr>
</table>
</div>
</div>

<div class="row">
 <div class="column2">
     &nbsp;----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 </div>
</div>

<div class="row">
 <div class="column2">
     <table>
         <tr>
             <td style="font-size: 8px !important; border-bottom:none !important;" width="40%"><center><b>ACKNOWLEDGEMENT RECEIPT</b></center></td>
             <td style="font-size: 8px !important; border-bottom:none !important;" width="40%"><center><b>AMRITLAL DESAI & COMPANY</b></center></td>
             <td style="font-size: 8px !important; border-bottom:none !important;"><b>No:</b></td>
         </tr>
         <tr>
             <td style="font-size: 6px !important; border-top:none !important;" width="40%"><center>(To be produced by the Customer/Dealer at the time of Battery Collection)</center></td>
             <td style="font-size: 6px !important; border-top:none !important;" width="40%"><center>ADCOPLEX, STATION ROAD,NEAR HOTEL PRINCE,BHUJ,9825025450</center></td>
             <td style="font-size: 8px !important; border-top:none !important;"></td>
         </tr>
     </table>
 </div>
</div>

<div class="row">
 <div class="column2">
     <table>
         <tr>
             <th width="40%">Batt. P/N:</th>
             <th width="40%">S/N:</th>
             <th>Date:</th>
         </tr>

         <tr>
             <td colspan="3">
                <b>Received from:</b>
                <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                Dealer &nbsp;&nbsp;

                <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                Customer &nbsp;&nbsp;

                <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                OED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <b>Proof of warrenty:</b>
                <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                Customer &nbsp;&nbsp; OED CF/Veh. Insu/RC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                Invoice &nbsp;&nbsp;

                <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
                WR-DSM/ACS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                SCF No.:
            </td>
        </tr>

        <tr>
         <td colspan="3">
             <b>Physical Condotion of Batt.:</b> &nbsp;&nbsp;

             <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
             Good &nbsp;&nbsp;&nbsp;

             <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
             Damage &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

             Specify damages, If any &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

             <b>ocv:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

             <b>Warranty Status:</b>
             <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
             Free &nbsp;&nbsp;

             <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
             Prorala &nbsp;&nbsp;

             <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
             Unsold &nbsp;&nbsp;

             <input type="checkbox" class="form_0006_fld_2-0 formFieldLabel">
             OW &nbsp;&nbsp;
         </td>
     </tr>

     <tr>
         <td colspan="2" style="border-right:none !important">
             <b>Nature of Problem:</b>
         </td>
         <td width="50%" style="border-left:none !important">
             FST Name & Sign.
         </td>
     </tr>

     <tr>
         <td colspan="3" style="font-size: 8px !important;">
             Note: Company is not liable if Battery is Not collected within 30 days, no claim whatsoever will be entertained thereafter.
         </td>
     </tr>
 </table>
</div>
</div>

</html>