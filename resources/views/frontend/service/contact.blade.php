@extends('frontend.layouts.main')
@section('title')
    Liên Hệ
@endsection
@section('content')

 <div class="main"> 
 <div class="reservation_top">          
        <div class=" contact_right">
            <h3>Liên Hệ</h3>
            <div class="contact-form">
                    <form method="post" action="contact-post.html">
                        <input type="text" class="textbox" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
                        <input type="text" class="textbox" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}">
                        <textarea value="Message" onfocus="this.value= '';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>
                        <input type="submit" value="Send">
                        <div class="clearfix"> </div>
                    </form>
                    <br>
                <p><strong>Telephone:</strong> 1900636467</p>
                <p><strong>E-mail:</strong> <a href="mailto@vintage.com">BookShop@gmail.com</a></p>
            </div>
        </div>
    </div>
   </div>

@endsection