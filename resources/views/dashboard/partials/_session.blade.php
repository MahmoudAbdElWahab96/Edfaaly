
@if(session('success'))

    <script src="{{asset('assets/js/noty.min.js')}}" type="text/javascript"></script>
    <script>
    
        new Noty({
            type: 'success',
            layout: 'topLeft',
            text: '{{session("success")}}',
            timeout: 3800,
            killer: true
        }).show();
        
        document.querySelector('.noty_bar').classList.add('alert');
        document.querySelector('.noty_bar').classList.add('alert-success');

    </script>

@endif