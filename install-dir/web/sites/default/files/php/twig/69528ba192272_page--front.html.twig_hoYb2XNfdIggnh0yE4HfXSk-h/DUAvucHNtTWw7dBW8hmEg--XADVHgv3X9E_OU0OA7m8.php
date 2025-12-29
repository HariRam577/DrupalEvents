<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* themes/custom/events_theme/templates/page--front.html.twig */
class __TwigTemplate_04939420f9cc75a5430dd2b87bbc89aa extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        yield "
";
        // line 9
        yield "<header class=\"site-header\">
  <div class=\"container\">
    <div class=\"site-logo\">
      <a href=\"";
        // line 12
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("<front>"));
        yield "\">Local Events</a>
    </div>
    ";
        // line 14
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 14)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 15
            yield "      <nav class=\"main-nav\">
        ";
            // line 16
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 16), "html", null, true);
            yield "
      </nav>
    ";
        }
        // line 19
        yield "  </div>
</header>

";
        // line 23
        yield "<section class=\"hero-section\">
  <div class=\"container\">
    <h1>Discover Amazing Events Near You</h1>
    <p>Connect with your community through music, tech, sports, and more</p>
    <a href=\"http://localhost/drupal/install-dir/web/events\" class=\"cta-button\">Explore Events</a>
  </div>
</section>

";
        // line 32
        yield "<main class=\"main-content\">
  <div class=\"container\">
    
    ";
        // line 36
        yield "    <section class=\"filter-bar\">
      <form class=\"filter-form\" action=\"/events\" method=\"get\">
        <div class=\"filter-group\">
          <label for=\"category-filter\">Category</label>
          <select name=\"category\" id=\"category-filter\">
            <option value=\"\">All Categories</option>
            <option value=\"music\">Music</option>
            <option value=\"tech\">Tech</option>
            <option value=\"sports\">Sports</option>
            <option value=\"community\">Community</option>
          </select>
        </div>
        <div class=\"filter-group\">
          <label for=\"date-filter\">Date</label>
          <input type=\"date\" name=\"date\" id=\"date-filter\">
        </div>
        <button type=\"submit\" class=\"filter-submit\">Search Events</button>
      </form>
    </section>

    ";
        // line 57
        yield "    <section class=\"featured-events\">
      <h2 class=\"section-title\">Featured Upcoming Events</h2>
      
      <div class=\"events-grid\" id=\"featured-events-container\">
        ";
        // line 62
        yield "      </div>
      
      <div class=\"text-center mt-4\">
        <a href=\"http://localhost/drupal/install-dir/web/events\" class=\"cta-button\">View All Events</a>
      </div>
    </section>

    ";
        // line 70
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 70)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 71
            yield "      <section class=\"page-content\">
        ";
            // line 72
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 72), "html", null, true);
            yield "
      </section>
    ";
        }
        // line 75
        yield "
  </div>
</main>

";
        // line 80
        yield "<footer class=\"site-footer\">
  <div class=\"container\">
    <p>&copy; ";
        // line 82
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " Local Events. All rights reserved.</p>
    ";
        // line 83
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 83)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 84
            yield "      ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 84), "html", null, true);
            yield "
    ";
        }
        // line 86
        yield "  </div>
</footer>

";
        // line 90
        yield "<script>
(function() {
  'use strict';
  
  // Fetch featured events from API
  fetch('/api/events/upcoming')
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success' && data.events.length > 0) {
        const container = document.getElementById('featured-events-container');
        const events = data.events.slice(0, 3); // Get first 3 events
        
        events.forEach(event => {
          const card = createEventCard(event);
          container.innerHTML += card;
        });
      }
    })
    .catch(error => {
      console.error('Error loading featured events:', error);
    });
  
  // Create event card HTML
  function createEventCard(event) {
    const date = new Date(event.date);
    const formattedDate = date.toLocaleDateString('en-US', { 
      month: 'short', 
      day: 'numeric',
      year: 'numeric'
    });
    
    const imageUrl = event.image_url || '/themes/custom/events_theme/images/placeholder.jpg';
    const categoryName = event.category ? event.category.name : 'Event';
    
    return `
      <article class=\"event-card\" tabindex=\"0\">
        <div class=\"event-image-wrapper\">
          <img src=\"\${imageUrl}\" alt=\"\${event.title}\" class=\"event-image\">
          <div class=\"date-badge\">\${formattedDate}</div>
        </div>
        <div class=\"event-content\">
          <h3 class=\"event-title\">
            <a href=\"/node/\${event.id}\">\${event.title}</a>
          </h3>
          <span class=\"category-chip\">\${categoryName}</span>
          <div class=\"event-location\">\${event.location}</div>
          <p class=\"event-summary\">\${event.summary}</p>
        </div>
      </article>
    `;
  }
})();
</script>";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/events_theme/templates/page--front.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  164 => 90,  159 => 86,  153 => 84,  151 => 83,  147 => 82,  143 => 80,  137 => 75,  131 => 72,  128 => 71,  125 => 70,  116 => 62,  110 => 57,  88 => 36,  83 => 32,  73 => 23,  68 => 19,  62 => 16,  59 => 15,  57 => 14,  52 => 12,  47 => 9,  44 => 7,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/custom/events_theme/templates/page--front.html.twig", "C:\\Xampp_New\\htdocs\\drupal\\install-dir\\web\\themes\\custom\\events_theme\\templates\\page--front.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 14];
        static $filters = ["escape" => 16, "date" => 82];
        static $functions = ["path" => 12];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'date'],
                ['path'],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
