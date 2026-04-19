<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Facture</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: green;
        margin-left: 35px;
    }
    .thanks p {
        color: green;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>
    @php
    $setting = App\Models\SiteSetting::find(1);
    @endphp

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
         <img src="{{ $setting->logo }}" alt="" width="150"/>
        </td>
        <td align="right">
            <div class="font" >
               <p>Email : {{ $setting->email }} </p>
               <p>Tél : +88{{ $setting->phone }}  </p>
               <p>Adresse : {{ $setting->address }}</p>
            </div>
        </td>
    </tr>
  </table>

  <table width="100%" style="background:white; padding:2px;"></table>

  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
          <p class="font" style="margin-left: 20px;">
           <strong>Nom :</strong> {{ $payment->name }} <br>
           <strong>Email :</strong> {{ $payment->email }} <br>
           <strong>Téléphone :</strong> {{ $payment->phone }} <br>
           <strong>Adresse :</strong> {{ $payment->address }} <br>
         </p>
        </td>
        <td>
          <p class="font">
            <h3><span style="color: green;">Facture :</span> #{{ $payment->invoice_no }}</h3>
            Date de commande : {{ $payment->order_date }} <br>
            Date de livraison : {{ $payment->order_date }} <br>
            Type de paiement : {{ $payment->payment_type }} </span>
         </p>
        </td>
    </tr>
  </table>
  <br/>
<h3>Produits</h3>

  <table width="100%">
    <thead style="background-color: green; color:#FFFFFF;">
      <tr class="font">
        <th>Image</th>
        <th>Nom du cours</th>
        <th>Catégorie</th>
        <th>Instructeur</th>
        <th>Prix du cours</th>
      </tr>
    </thead>
    <tbody>
     @foreach ($orderItem as $item)
      <tr class="font">
        <td align="center">
            <img src="{{ public_path($item->course->course_image) }}" height="60px;" width="60px;" alt="">
        </td>
        <td align="center">{{ $item->course->course_name }}</td>
        <td align="center">{{ $item->course->category->category_name }}</td>
        <td align="center">{{ $item->instructor->name }}</td>
        <td align="center">${{ $item->price }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
            <h2><span style="color: green;">Sous-total :</span> {{ $payment->total_amount }}</h2>
            <h2><span style="color: green;">Total :</span> {{ $payment->total_amount }}</h2>
        </td>
    </tr>
  </table>
  <div class="mt-3 thanks">
    <p>Merci pour votre achat de cours !</p>
  </div>
  <div class="float-right mt-5 authority">
      <p>-----------------------------------</p>
      <h5>Signature de l'autorité :</h5>
    </div>
</body>
</html>
