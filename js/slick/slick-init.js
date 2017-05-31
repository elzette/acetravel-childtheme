jQuery(document).ready(function(){
  
  jQuery('.home-carousel').slick({
  	lazyLoad: 'ondemand',
  	dots: false,
  	infinite: true,
  	speed: 300,
  	slidesToShow: 3,
  	slidesToScroll: 1,
  	autoplay: true,
  	autoplaySpeed: 6000,
  	responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
  });
  
  jQuery('.partner-logos').slick({
  	lazyLoad: 'ondemand',
  	dots: false,
  	infinite: true,
  	speed: 300,
  	slidesToShow: 5,
  	slidesToScroll: 1,
  	autoplay: true,
  	autoplaySpeed: 6000,
  	responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
  ]
  });
  
});