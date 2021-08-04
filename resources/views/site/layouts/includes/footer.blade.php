<footer class="footer">
    <div class="footer-widgets">
        <div class="col-md-4">
            <div class="widget">
                <div class="widget-title">
                    <h3>Contact Us</h3>
                </div><!--End widget-title-->
                <div class="widget-content">
                    <ul class="contact-widget">
                        <li>
                            <i class="fa fa-whatsapp"></i>
                            <span>+201002092604</span>
                        </li>
                        <li>
                            <i class="fa fa-envelope-o"></i>
                            <span>mahmoudabdelwahab9696@gmail.com</span>
                        </li>
                        <li>
                            <i class="fa fa-whatsapp"></i>
                            <span>+201002092604</span>
                        </li>
                    </ul><!--End contact-widget-->
                </div><!--End widget-content-->
            </div><!--End widget-->
        </div><!--End col-md-4-->
        <div class="col-md-4">
            <div class="widget">
                <div class="widget-title">
                    <h3>Connect With Us</h3>
                </div><!--End widget-title-->
                <div class="widget-content">
                    <ul class="social-widget">
                        <li>
                            <a href="">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                    </ul><!--End social-widget-->
                </div><!--End widget-content-->
            </div><!--End widget-->
            <div class="widget">
                <div class="widget-title">
                    <h3>Newsletter</h3>
                </div><!--End widget-title-->
                <div class="widget-content">
                </div><!--End widget-content-->
            </div><!--End widget-->
        </div><!--End col-md-4-->

        
        <div class="col-md-4">
            <div class="widget">
                <div class="widget-title">
                    <img src="{{asset('storage/images/logo.png')}}" width="80px">
                </div><!--End widget-title-->
                <div class="widget-content">
                    <ul class="tags tabel-tags map-widget">
                        <li><a href="{{route('site.home.index')}}">home</a></li>
                    </ul>
                </div><!--End widget-content-->
            </div><!--End widget-->
        </div><!--End col-md-4-->
    </div><!--End footer-widgets-->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    By Edfaaly
                </div><!--End col-md-6-->
                <div class="col-md-6 text-right">
                    © 2018 Grade eCommerce
                </div><!--End col-md-6-->
            </div><!--End row-->
        </div><!--End container-->
        <div class="scroll-top">
            <i class="fa fa-arrow-up"></i>
        </div><!--End scroll-top-->
    </div><!--End copyright-->
</footer><!--End Footer-->

<!--Scripts Plugins-->
<script src="{{asset('assets/admin/jquery/jquery.js')}}"></script>
<script src="{{asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/admin/owl-carousel/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/admin/jcarousellite.js')}}"></script>


<script src="{{asset('public/js/main.js')}}"></script>
<script>

$(document).on('submit','.sent-mail', function(e){

    e.preventDefault();

    $.ajax({
      url: $(this).attr('action'),
      data: $(this).serialize(),
      method: 'get',
      success: function() {
        $("input[name='email']").val('');
      }
    });


});

</script>
