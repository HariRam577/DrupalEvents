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
<header class=\"site-header\">
  <div class=\"container\">
    <div class=\"site-logo\">
      <a href=\"";
        // line 11
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("<front>"));
        yield "\">Local Events</a>
    </div>
    ";
        // line 13
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 13)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 14
            yield "      <nav class=\"main-nav\">
        ";
            // line 15
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 15), "html", null, true);
            yield "
      </nav>
    ";
        }
        // line 18
        yield "  </div>
</header>

<section class=\"hero-section\">
  <div class=\"container\">
    <h1>Discover Amazing Events Near You</h1>
    <p>Connect with your community through music, tech, sports, and more</p>
    <a href=\"http://localhost/drupal/install-dir/web/events\" class=\"cta-button\">Explore Events</a>
  </div>
</section>

<main class=\"main-content\">
  <div class=\"container\">
    <section class=\"filter-bar\">
      <form class=\"filter-form\" id=\"events-filter-form\">
        <div class=\"filter-group\">
          <label for=\"category-filter\">Category</label>
          <select name=\"field_category_target_id\" id=\"category-filter\">
            <option value=\"\">All Categories</option>
            ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["category_options"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
            // line 38
            yield "              <option value=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, true, 38), "html", null, true);
            yield "\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["option"], "label", [], "any", false, false, true, 38), "html", null, true);
            yield "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['option'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        yield "          </select>
        </div>
        <div class=\"filter-group\">
          <label for=\"date-filter\">Date</label>
          <input type=\"date\" name=\"field_event_date_time_value\" id=\"date-filter\">
        </div>
        <button type=\"submit\" class=\"filter-submit\">Filter Events</button>
        <button type=\"button\" id=\"clear-filters\" class=\"clear-button\">Clear</button>
      </form>
    </section>

    <section class=\"featured-events\">
      <h2 class=\"section-title\">Featured Upcoming Events</h2>
      <div class=\"events-grid\" id=\"featured-events-container\">
        <div class=\"loading\">Loading featured events...</div>
      </div>
      <div class=\"text-center mt-4\">
        <a href=\"http://localhost/drupal/install-dir/web/events\" class=\"cta-button\">View All Events</a>
      </div>
    </section>
  </div>
</main>

<footer class=\"site-footer\">
  <div class=\"container\">
    <p>&copy; ";
        // line 65
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " Local Events. All rights reserved.</p>
  </div>
</footer>

<script>
(function() {
  'use strict';
  
  const container = document.getElementById('featured-events-container');
  const filterForm = document.getElementById('events-filter-form');
  const categorySelect = document.getElementById('category-filter');
  const dateInput = document.getElementById('date-filter');
  const API_BASE = 'http://localhost/drupal/install-dir/web';
  
  // Load events on page load
  loadFeaturedEvents();
  
  // Handle filter form submission
  filterForm.addEventListener('submit', function(e) {
    e.preventDefault();
    loadFeaturedEvents();
  });
  
  // Handle clear filters button
  document.getElementById('clear-filters').addEventListener('click', function() {
    categorySelect.value = '';
    dateInput.value = '';
    loadFeaturedEvents();
  });
  
  function loadFeaturedEvents() {
    const apiParams = new URLSearchParams();
    
    // Get current filter values
    const category = categorySelect.value;
    const date = dateInput.value;
    
    // Add filters to API params if they have values
    if (category) {
      apiParams.append('category', category);
    }
    if (date) {
      apiParams.append('date', date);
    }
    
    const url = `\${API_BASE}/api/events/upcoming\${apiParams.toString() ? '?' + apiParams.toString() : ''}`;
    
    console.log('Fetching:', url);
    
    container.innerHTML = '<div class=\"loading\">Loading events...</div>';
    
    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP \${response.status}: \${response.statusText}`);
        }
        return response.json();
      })
      .then(data => renderEvents(data))
      .catch(error => {
        console.error('API Error:', error);
        container.innerHTML = `<div class=\"error\">Unable to load events. Please try again later.</div>`;
      });
  }
  
  function renderEvents(data) {
    container.innerHTML = '';
    
    if (data.status === 'success' && data.events?.length > 0) {
      // Show up to 3 featured events
      data.events.slice(0, 3).forEach(event => {
        container.appendChild(createEventCard(event));
      });
    } else {
      const filterActive = categorySelect.value || dateInput.value;
      const message = filterActive 
        ? 'No events match your filters. Try adjusting your search criteria.'
        : 'No upcoming events at this time. Check back soon!';
      container.innerHTML = `<p class=\"no-events\">\${message}</p>`;
    }
  }
  
  function createEventCard(event) {
    const date = new Date(event.date);
    const formattedDate = date.toLocaleDateString('en-US', { 
      month: 'short', 
      day: 'numeric', 
      year: 'numeric'
    });
    
    const imageUrl = event.image_url || '/themes/custom/events_theme/images/placeholder.jpg';
    const categoryName = event.category?.name || 'Event';
    const location = event.location || 'Location TBD';
    const summary = event.summary || (event.body ? event.body.substring(0, 100) + '...' : 'No description');
    
    const article = document.createElement('article');
    article.className = 'event-card';
    article.tabIndex = 0;
    article.innerHTML = `
      <div class=\"event-image-wrapper\">
        <img src=\"\${imageUrl}\" alt=\"\${event.title}\" class=\"event-image\" loading=\"lazy\" 
             onerror=\"this.src='/themes/custom/events_theme/images/placeholder.jpg'\">
        <div class=\"date-badge\">\${formattedDate}</div>
      </div>
      <div class=\"event-content\">
        <h3 class=\"event-title\"><a href=\"/node/\${event.id}\">\${event.title}</a></h3>
        <span class=\"category-chip\">\${categoryName}</span>
        <div class=\"event-location\">\${location}</div>
        <p class=\"event-summary\">\${summary}</p>
      </div>
    `;
    
    return article;
  }
})();
</script>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page", "category_options"]);        yield from [];
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
        return array (  129 => 65,  102 => 40,  91 => 38,  87 => 37,  66 => 18,  60 => 15,  57 => 14,  55 => 13,  50 => 11,  44 => 7,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/custom/events_theme/templates/page--front.html.twig", "C:\\Xampp_New\\htdocs\\drupal\\install-dir\\web\\themes\\custom\\events_theme\\templates\\page--front.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 13, "for" => 37];
        static $filters = ["escape" => 15, "date" => 65];
        static $functions = ["path" => 11];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for'],
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
