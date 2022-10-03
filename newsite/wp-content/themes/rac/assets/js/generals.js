/**
 * IPG Mediabrands
 *
 *
 * This file contains IPG Mediabrands Information
 * Use, disclosure or reproduction is prohibited.
 *
 * @author    IPG Mediabrands / Benjamín García

 */


$( document ).ready(function() {
	//Start the Party
	homeSlider();
  homeProductsSlider();
  ZoomGallery();
  accordionList();
  //categoryMenu();
});

function homeSlider() {
	$('.home-slider').owlCarousel({
	  loop: true,
	  margin: 0,
	  items: 1,
	  nav:true,
    dots:false
	})
  }

  function homeProductsSlider() {
    $('.home-products-slider-block-1').owlCarousel({
      loop: true,
      margin: 0,
      items: 1,
      nav:true,
      responsive:{
          0:{
              items:1,
              nav:true
          },
          600:{
              items:3,
              nav:true
          },
          1000:{
              items:5,
              nav:true,
              loop:false
          }
      }
      
    });
    $('.home-products-slider-block-2').owlCarousel({
      loop: true,
      margin: 0,
      items: 1,
      nav:true,
      responsive:{
          0:{
              items:1,
              nav:true
          },
          600:{
              items:3,
              nav:true
          },
          1000:{
              items:5,
              nav:true,
              loop:false
          }
      }
      
    });
    $('.home-products-slider-block-3').owlCarousel({
      loop: true,
      margin: 0,
      items: 1,
      nav:true,
      responsive:{
          0:{
              items:1,
              nav:true
          },
          600:{
              items:3,
              nav:true
          },
          1000:{
              items:5,
              nav:true,
              loop:false
          }
      }
    });
    $('#beneficios-carousel').owlCarousel({
      loop: true,
      margin: 0,
      items: 1,
      nav:true,
      responsive:{
          0:{
              items:1,
              nav:true
          },
          600:{
              items:3,
              nav:true
          },
          1000:{
              items:7,
              nav:true,
              loop:false
          }
      }
    });
  }

  function ZoomGallery(){
    $('.show').zoomImage();
    $('.show-small-img:first-of-type').css({'border': 'solid 1px #951b25', 'padding': '2px'})
    $('.show-small-img:first-of-type').attr('alt', 'now').siblings().removeAttr('alt')
    $('.show-small-img').click(function () {
      $('#show-img').attr('src', $(this).attr('src'))
      $('#big-img').attr('src', $(this).attr('src'))
      $(this).attr('alt', 'now').siblings().removeAttr('alt')
      $(this).css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
      if ($('#small-img-roll').children().length > 4) {
        if ($(this).index() >= 3 && $(this).index() < $('#small-img-roll').children().length - 1){
          $('#small-img-roll').css('left', -($(this).index() - 2) * 76 + 'px')
        } else if ($(this).index() == $('#small-img-roll').children().length - 1) {
          $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
        } else {
          $('#small-img-roll').css('left', '0')
        }
      }
    })
    $('#next-img').click(function (){
      $('#show-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
      $('#big-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
      $(".show-small-img[alt='now']").next().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
      $(".show-small-img[alt='now']").next().attr('alt', 'now').siblings().removeAttr('alt')
      if ($('#small-img-roll').children().length > 4) {
        if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
          $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
        } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
          $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
        } else {
          $('#small-img-roll').css('left', '0')
        }
      }
    })
    $('#prev-img').click(function (){
      $('#show-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
      $('#big-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
      $(".show-small-img[alt='now']").prev().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
      $(".show-small-img[alt='now']").prev().attr('alt', 'now').siblings().removeAttr('alt')
      if ($('#small-img-roll').children().length > 4) {
        if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
          $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
        } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
          $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
        } else {
          $('#small-img-roll').css('left', '0')
        }
      }
    });
  }

  function accordionList(){
    $('.category-list-accordion .principal-list').on('click', function(){
      if( $(this).hasClass('accordion-open') ){
        $('.category-list-accordion .principal-list').removeClass('accordion-open');
        $('.category-list-accordion .principal-list ul').hide();
      }
      else{
        $('.category-list-accordion .principal-list').removeClass('accordion-open');
        $('.category-list-accordion .principal-list ul').hide();
        $(this).addClass('accordion-open');
        $(this).find('ul').show();
      }
    });
  }

  $('.acordeon dt').on('click', function() {
    if(!$(this).hasClass('active')) {
      $('.acordeon dt').removeClass('active');
      $('.acordeon dl dd').slideUp();
    }
    $(this).toggleClass("active");
    $(this).parents('dl').children('dd').slideToggle();
  });