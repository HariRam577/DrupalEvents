/**
 * Events Theme - Main JavaScript
 */

(function ($, Drupal) {
  "use strict";

  Drupal.behaviors.eventsTheme = {
    attach: function (context, settings) {
      // Add smooth scrolling for anchor links
      $('a[href^="#"]', context)
        .once("smooth-scroll")
        .on("click", function (e) {
          var target = $(this.getAttribute("href"));
          if (target.length) {
            e.preventDefault();
            $("html, body").animate(
              {
                scrollTop: target.offset().top - 80,
              },
              600
            );
          }
        });

      // Enhanced event card accessibility
      $(".event-card", context)
        .once("event-card-focus")
        .each(function () {
          var $card = $(this);
          var $link = $card.find(".event-title a");

          // Make entire card clickable
          $card.on("click", function (e) {
            if (e.target.tagName !== "A") {
              window.location.href = $link.attr("href");
            }
          });

          // Add keyboard navigation
          $card.on("keydown", function (e) {
            if (e.key === "Enter" || e.key === " ") {
              e.preventDefault();
              window.location.href = $link.attr("href");
            }
          });
        });

      // Filter form enhancement
      $(".filter-form", context)
        .once("filter-enhancement")
        .each(function () {
          var $form = $(this);

          // Auto-submit on select change (optional)
          $form.find("select").on("change", function () {
            // Uncomment to enable auto-submit
            // $form.submit();
          });

          // Add loading state on submit
          $form.on("submit", function () {
            var $submit = $form.find(".filter-submit");
            $submit.prop("disabled", true).text("Filtering...");
          });
        });

      // Format date badges
      $(".date-badge", context)
        .once("date-format")
        .each(function () {
          var $badge = $(this);
          var dateText = $badge.text().trim();

          // Try to parse and format the date nicely
          var date = new Date(dateText);
          if (!isNaN(date.getTime())) {
            var options = { month: "short", day: "numeric" };
            var formatted = date.toLocaleDateString("en-US", options);
            $badge.text(formatted);
          }
        });

      // Add animation on scroll (fade in cards)
      if ("IntersectionObserver" in window) {
        var observer = new IntersectionObserver(
          function (entries) {
            entries.forEach(function (entry) {
              if (entry.isIntersecting) {
                entry.target.style.opacity = "0";
                entry.target.style.transform = "translateY(20px)";
                entry.target.style.transition =
                  "opacity 0.6s ease, transform 0.6s ease";

                setTimeout(function () {
                  entry.target.style.opacity = "1";
                  entry.target.style.transform = "translateY(0)";
                }, 100);

                observer.unobserve(entry.target);
              }
            });
          },
          { threshold: 0.1 }
        );

        $(".event-card", context)
          .once("fade-in")
          .each(function () {
            observer.observe(this);
          });
      }
    },
  };
})(jQuery, Drupal);
