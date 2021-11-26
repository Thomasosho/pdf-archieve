<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Archiever</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- toastr -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" 
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <!-- end toast -->
    </head>
    <body>
        <header class="p-3 bg-dark text-white">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                        <em>The Archiever</em>
                    </a>

                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="/file" class="nav-link px-2 {{ (request()->is('file')) ? 'text-secondary' : 'text-white' }}">Upload</a></li>
                        <li><a href="/type" class="nav-link px-2 {{ (request()->is('type')) ? 'text-secondary' : 'text-white' }}">Sort by File Type</a></li>
                        <li><a href="/date" class="nav-link px-2 {{ (request()->is('date')) ? 'text-secondary' : 'text-white' }}">Sort by Date</a></li>
                    </ul>

                    <form class="col-12 col-lg-auto mb-10 mb-lg-8 me-lg-10">
                        <input type="search" class="form-control form-control-dark" placeholder="Search by responsible person, class, date, keyword, description and so on..." aria-label="Search">
                    </form>
                </div>
            </div>
        </header>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 py-3 px-5">
                        <h2>Sample Demonstration</h2>
                        <p>Sort by date</p>
                    </div>
                    <div class="col-md-8 px-5">
                        <h4>Archive</h4>
                        <ul>
                            @foreach($sort as $date => $items )
                            <li>
                                <p style="font-weight:bold; font-style:itallic;">{{$date}} </p>
                                <ul>
                                    @foreach ($items as $item) 
                                        <li>
                                            {{$item->orig_filename}} 
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 
        <!-- pop up -->
        <script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        </script>
        <script>
            @if(Session::has('success'))
                toastr.options =
                {
                "closeButton" : true,
                "progressBar" : true
                }
                    toastr.success("{{ session('success') }}");
            @endif
            @if(Session::has('error'))
                toastr.options =
                {
                "closeButton" : true,
                "progressBar" : true
                }
                    toastr.error("{{ session('error') }}");
            @endif
            @if(Session::has('info'))
                toastr.options =
                {
                "closeButton" : true,
                "progressBar" : true
                }
                    toastr.info("{{ session('info') }}");
            @endif
            @if(Session::has('warning'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                        toastr.warning("{{ session('warning') }}");
            @endif
        </script>
    </body>
</html>