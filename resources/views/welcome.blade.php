<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skills Job Match</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        body::before {
            display: block;
            content: '';
            height: 60px;
        }

        #map {
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }

        @media (min-width: 768px) {
            .news-input {
                width: 50%;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><b>Skills Job Match</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu" aria-controls="navmenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#questions">Questions</a>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="login">Dashboard</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<!-- Showcase -->
<section class="bg-dark text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start">
    <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <h1>Match your <span class="text-warning"> Skills </span> to <span class="text-warning">Jobs</span></h1>
                <p class="lead my-4">
                    <span class="text-primary">Skills Job Match</span> is developed to support students of the <span class="text-primary">University of East London</span>.
                    It will bring out the specific skills relevant to the job you are applying for.</p>
                <a href="register" class="btn btn-primary btn-lg" role="button">Register Now</a>
            </div>
            <img
                class="img-fluid w-50 d-none d-sm-block"
                src="{{ URL::asset('images/header_image.svg') }}"
                alt="A student creating a resume"
            />
        </div>
    </div>
</section>

<!-- Newsletter
<section class="bg-primary text-light p-5">
    <div class="container">
        <div class="d-md-flex justify-content-between align-items-center">
            <h3 class="mb-3 mb-md-0">Sign Up For Our Newsletter</h3>

            <div class="input-group news-input">
                <input type="text" class="form-control" placeholder="Enter Email" />
                <button class="btn btn-dark btn-lg" type="button">Submit</button>
            </div>
        </div>
    </div>
</section>
-->

<!-- Boxes -->
<section class="p-5">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md">
                <div class="card bg-dark text-light">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h3 class="card-title mb-3">Virtual</h3>
                        <p class="card-text">
                            Match practicals, workshops and other activities you have been involved in, and the application will show specific skills relevant to the job you are applying for.
                        </p>
                        {{--<a href="#" class="btn btn-primary">See Programmes</a>--}}
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card bg-secondary text-light">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                            <i class="bi bi-person-square"></i>
                        </div>
                        <h3 class="card-title mb-3">Current State</h3>
                        <p class="card-text">
                            We are currently testing the application with current students of the University of East London. Your feedback is very important to us.
                        </p>
{{--                        <a href="#" class="btn btn-dark">Tell us</a>--}}
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card bg-dark text-light">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="card-title mb-3">Research</h3>
                        <p class="card-text">
                            The Skills Evaluation Tool is a result of a research conducted by Dr Elizabeth Westhead and Dr Stefano Casalotti.
                        </p>
                        {{--<a href="#" class="btn btn-primary">Read More</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Learn Sections -->
<section id="learn" class="p-5">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md">
                <img src="{{ URL::asset('images/research.svg') }}" class="img-fluid" alt="" />
            </div>
            <div class="col-md p-5">
                <h2>Identify your skills

                </h2>
                <p class="lead">
                    A web application to identify current and past students' skills.
                </p>
                <p>
                    The web application is developed to support HSB students at the University of East London, to identify their skills when applying for jobs. We have observed over the years that many students cannot identify their skills applying for jobs and do not emphasise enough the skills that have learned during their University programme. So we have created a database of all the practicals, workshops and other activities you have been involved in, and created a web application that will bring out the specific skills relevant to the job you are applying for.
                </p>
                <!-- <a href="#" class="btn btn-light mt-3">
                  <i class="bi bi-chevron-right"></i> Read More
                </a> -->
            </div>
        </div>
    </div>
</section>

<!-- Question Accordion -->
<section id="questions" class="p-5">
    <div class="container">
        <h2 class="text-center mb-4">Frequently Asked Questions</h2>
        <div class="accordion accordion-flush" id="questions">
            <!-- Item 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#question-one"
                    >
                        How do I access the Skills Job Match application?
                    </button>
                </h2>
                <div
                    id="question-one"
                    class="accordion-collapse collapse"
                    data-bs-parent="#questions"
                >
                    <div class="accordion-body">
                        You can register using the registration link located in the navigation bar.
                    </div>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#question-two"
                    >
                        How much does it cost?
                    </button>
                </h2>
                <div
                    id="question-two"
                    class="accordion-collapse collapse"
                    data-bs-parent="#questions"
                >
                    <div class="accordion-body">
                        It's free to use.
                    </div>
                </div>
            </div>
            <!-- Item 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#question-three"
                    >
                        How can I provide feedback?
                    </button>
                </h2>
                <div
                    id="question-three"
                    class="accordion-collapse collapse"
                    data-bs-parent="#questions"
                >
                    <div class="accordion-body">
                        Once you registered in the system you can provide feedback using the Feeback link located in the navigation panel.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="p-5 bg-dark text-white text-center position-relative">
    <div class="container">
        <p class="lead">Copyright &copy; 2022 University of East London</p>

        <a href="#" class="position-absolute bottom-0 end-0 p-5">
            <i class="bi bi-arrow-up-circle h1"></i>
        </a>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
</body>
</html>
