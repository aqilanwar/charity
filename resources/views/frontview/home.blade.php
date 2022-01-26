@extends('frontview.master')
@section('title', 'Home')

@section('content')
  <!-- ======= hero Section ======= -->
  <section id="hero">
    <div class="hero-content" data-aos="fade-up">
      <h2 style="font-size : 39px">"When a person dies, all their deeds end except three:<br>
       a continuing charity, beneficial knowledge and a child who prays for them." <br> (Hadith, Muslim). 
        <br><span style=" font-style: italic;">#STUDENT4CHARITY</span> </h2>

      <div>
        <a href="{{route('list.event')}}" class="btn-get-started scrollto">Join Upcoming Charity Events</a>
        <a href="{{url('/donation')}}" class="btn-projects scrollto">Donate</a>
      </div>
    </div>

    <div class="hero-slider swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide" style="background-image: url('frontview/assets/img/hero-carousel/2.jpg');" ></div>
        <div class="swiper-slide" style="background-image: url('frontview/assets/img/hero-carousel/3.jpg');" ></div>
        <div class="swiper-slide" style="background-image: url('frontview/assets/img/hero-carousel/4.jpg');" ></div>
        <div class="swiper-slide" style="background-image: url('frontview/assets/img/hero-carousel/1.jpg');" ></div>
      </div>
    </div>

  </section><!-- End Hero Section -->
<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src="{{asset('frontview/assets/img/about-img.png')}}"alt="">
          </div>

          <div class="col-lg-6 content">
            <h2>How can i participate <br> as a volunteer ?</h2>
            <h3>" Good hearts comes with a good deeds !"</h3>  

            <ul>
              <li><i class="bi bi-check-circle"></i> Register a new account</li>
              <li><i class="bi bi-check-circle"></i> Choose the available event from the list</li>
              <li><i class="bi bi-check-circle"></i> Submit your participation as a volunteer</li>
              <li><i class="bi bi-check-circle"></i> Show up yourself at the respective place during the event date!</li>
            </ul>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Why you should join us</h2>
          <h5>Charity is important because it raises awareness of issues and gives donors the power to do something about them.</h5>
        </div>

        <div class="row gy-4">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
              <div class="icon"><i class="bi bi-briefcase"></i></div>
              <h4 class="title"><a href="">Giving to charity strengthens personal values</a></h4>
              <p class="description">Having the power to improve the lives of others is, to many people, a privilege, and one that comes with its own sense of obligation. Acting on these powerful feelings of responsibility is a great way to reinforce our own personal values and feel like we’re living in a way that is true to our own ethical beliefs.</p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <div class="icon"><i class="bi bi-card-checklist"></i></div>
              <h4 class="title"><a href="">Everything is well organized</a></h4>
              <p class="description">Student4Charity allow student from IIUM to organize and manage a charity event. Every event will be managed and controlled by the responsible organizer team.</p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="box">
              <div class="icon"><i class="bi bi-bar-chart"></i></div>
              <h4 class="title"><a href="">You raise awareness through charity </a></h4>
              <p class="description">?</p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="box">
              <div class="icon"><i class="bi bi-binoculars"></i></div>
              <h4 class="title"><a href="">Explore, make friends and gain new experience</a></h4>
              <p class="description">While some people are naturally outgoing, others are shy and have a hard time meeting new people. Volunteering gives you the opportunity to practice and develop your social skills, since you are meeting regularly with a group of people with common interests. Once you have momentum, it’s easier to branch out and make more friends and contacts.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->


 <!-- ======= Contact Section ======= -->
 <section id="contact">
  <div class="container" data-aos="fade-up">
    <div class="section-header">
      <h2>Contact Us</h2>
      <h4>Stay updated with the latest charity event from us by following our social media.</h4>
    </div>

    <div class="row contact-info">

      <div class="col-md-4">
        <div class="contact-address">
          <i class="bi bi-facebook text-primary"></i>
          <h3><a href="https://www.facebook.com/StudentXCharity" target="_blank">Facebook</a></h3>
        </div>
      </div>

      <div class="col-md-4">
        <div class="contact-phone">
          <i class="bi bi-twitter text-primary"></i>
          <h3><a href="https://twitter.com/studentxcharity" target="_blank">Twitter</a></h3>
        </div>
      </div>

      <div class="col-md-4">
        <div class="contact-email">
          <i class="bi bi-envelope text-primary"></i>
          <h3><a href="mailto:student4charity@gmail.com">Email : student4charity@gmail.com</a></h3>
          <p></p>
        </div>
      </div>

    </div>
  </div>
</section><!-- End Contact Section -->


    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action">
      <div class="container" data-aos="zoom-out">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-start">
            <h3 class="cta-title">You can make a difference.</h3>
            <p class="cta-text"> 
              Student4Charity connects every student in IIUM. We help fellow nonprofits access the funding, tools, training, and support they need to serve their communities.
            </p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href=" {{url('/register')}} ">Sign Up Now</a>
          </div>
        </div>
      </div>
    </section><!-- End Call To Action Section -->

  </main><!-- End #main -->

  @endsection