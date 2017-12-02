$(document).ready(function() {
  setUpStarListeners();
});

function setUpStarListeners() {
  $(".starGroup").each(function() {
     $(this).find("i").eq(0).click(function() {
        $(this).parent().data("rating", 0);
        for (var j = 0; j < 5; j++) {
           if (j <= 0) {
              $(this).parent().find("i").eq(j).removeClass("fa-star-o");
              $(this).parent().find("i").eq(j).addClass("fa-star");
           } else {
              $(this).parent().find("i").eq(j).removeClass("fa-star");
              $(this).parent().find("i").eq(j).addClass("fa-star-o");
           }
        }
     });

     $(this).find("i").eq(1).click(function() {
        $(this).parent().data("rating", 1);
        for (var j = 0; j < 5; j++) {
           if (j <= 1) {
              $(this).parent().find("i").eq(j).removeClass("fa-star-o");
              $(this).parent().find("i").eq(j).addClass("fa-star");
           } else {
              $(this).parent().find("i").eq(j).removeClass("fa-star");
              $(this).parent().find("i").eq(j).addClass("fa-star-o");
           }
        }
     });

     $(this).find("i").eq(2).click(function() {
        $(this).parent().data("rating", 2);
        for (var j = 0; j < 5; j++) {
           if (j <= 2) {
              $(this).parent().find("i").eq(j).removeClass("fa-star-o");
              $(this).parent().find("i").eq(j).addClass("fa-star");
           } else {
              $(this).parent().find("i").eq(j).removeClass("fa-star");
              $(this).parent().find("i").eq(j).addClass("fa-star-o");
           }
        }
     });

     $(this).find("i").eq(3).click(function() {
        $(this).parent().data("rating", 3);
        for (var j = 0; j < 5; j++) {
           if (j <= 3) {
              $(this).parent().find("i").eq(j).removeClass("fa-star-o");
              $(this).parent().find("i").eq(j).addClass("fa-star");
           } else {
              $(this).parent().find("i").eq(j).removeClass("fa-star");
              $(this).parent().find("i").eq(j).addClass("fa-star-o");
           }
        }
     });

     $(this).find("i").eq(4).click(function() {
        $(this).parent().data("rating", 4);
        for (var j = 0; j < 5; j++) {
           if (j <= 4) {
              $(this).parent().find("i").eq(j).removeClass("fa-star-o");
              $(this).parent().find("i").eq(j).addClass("fa-star");
           } else {
              $(this).parent().find("i").eq(j).removeClass("fa-star");
              $(this).parent().find("i").eq(j).addClass("fa-star-o");
           }
        }
     });
    
    // ---
    
     $(this).find("i").eq(0).mouseenter(function() {
        for (var j = 0; j < 5; j++) {
           if (j <= 0) {
              $(this).parent().find("i").eq(j).removeClass("fa-star-o");
              $(this).parent().find("i").eq(j).addClass("fa-star");
           } else {
              $(this).parent().find("i").eq(j).removeClass("fa-star");
              $(this).parent().find("i").eq(j).addClass("fa-star-o");
           }
        }
     });
    
     $(this).find("i").eq(1).mouseenter(function() {
        for (var j = 0; j < 5; j++) {
           if (j <= 1) {
              $(this).parent().find("i").eq(j).removeClass("fa-star-o");
              $(this).parent().find("i").eq(j).addClass("fa-star");
           } else {
              $(this).parent().find("i").eq(j).removeClass("fa-star");
              $(this).parent().find("i").eq(j).addClass("fa-star-o");
           }
        }
       
     });
     $(this).find("i").eq(2).mouseenter(function() {
        for (var j = 0; j < 5; j++) {
           if (j <= 2) {
              $(this).parent().find("i").eq(j).removeClass("fa-star-o");
              $(this).parent().find("i").eq(j).addClass("fa-star");
           } else {
              $(this).parent().find("i").eq(j).removeClass("fa-star");
              $(this).parent().find("i").eq(j).addClass("fa-star-o");
           }
        }
     });
    
     $(this).find("i").eq(3).mouseenter(function() {
        for (var j = 0; j < 5; j++) {
           if (j <= 3) {
              $(this).parent().find("i").eq(j).removeClass("fa-star-o");
              $(this).parent().find("i").eq(j).addClass("fa-star");
           } else {
              $(this).parent().find("i").eq(j).removeClass("fa-star");
              $(this).parent().find("i").eq(j).addClass("fa-star-o");
           }
        }
     });
    
     $(this).find("i").eq(4).mouseenter(function() {
        for (var j = 0; j < 5; j++) {
           if (j <= 4) {
              $(this).parent().find("i").eq(j).removeClass("fa-star-o");
              $(this).parent().find("i").eq(j).addClass("fa-star");
           } else {
              $(this).parent().find("i").eq(j).removeClass("fa-star");
              $(this).parent().find("i").eq(j).addClass("fa-star-o");
           }
        }
     });
    
    $(this).find("i").mouseleave(function() {
        for (var j = 0; j < 5; j++) {
           if (j <= $(this).parent().data("rating")) {
              $(this).parent().find("i").eq(j).removeClass("fa-star-o");
              $(this).parent().find("i").eq(j).addClass("fa-star");
           } else {
              $(this).parent().find("i").eq(j).removeClass("fa-star");
              $(this).parent().find("i").eq(j).addClass("fa-star-o");
           }
        }
    });
    
    
  });
}