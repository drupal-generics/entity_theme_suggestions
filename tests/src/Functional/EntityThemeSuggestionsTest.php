<?php

namespace Drupal\Tests\entity_theme_suggestions\Functional;

use Drupal\node\Entity\Node;
use Drupal\Tests\BrowserTestBase;

/**
 * Class EntityThemeSuggestionsTest.
 *
 * @group entity_theme_suggestions
 */
class EntityThemeSuggestionsTest extends BrowserTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = [
    'system',
    'user',
    'node',
    'entity_theme_suggestions',
    'entity_theme_suggestions_test',
  ];

  /**
   * User that can access the test node.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $user;

  /**
   * The test node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $testNode;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    \Drupal::service('twig')->enableDebug();
    // Create user that can access the popup test page.
    $this->user = $this->drupalCreateUser([
      'administer site configuration',
    ]);
    $this->drupalLogin($this->user);

    $node_type = $this->drupalCreateContentType(['type' => 'test_type']);
    $this->testNode = Node::create([
      'type' => $node_type->id(),
      'title' => 'Test title',
    ]);
    $this->testNode->save();
  }

  /**
   * Tests if the node is rendered with the test template.
   */
  public function testNodeThemeSuggestion() {
    $this->drupalGet('node/' . $this->testNode->id());
    $session_assert = $this->assertSession();
    $page = $this->getSession()->getPage();
    $session_assert->statusCodeEquals(200);

    // Checks if the node test wrapper was rendered.
    $custom_wrapper = $page->find('css', 'div#suggestion-test-wrapper');
    $this->assertNotEmpty($custom_wrapper, t('The custom wrapper is not rendered.'));
  }

}
