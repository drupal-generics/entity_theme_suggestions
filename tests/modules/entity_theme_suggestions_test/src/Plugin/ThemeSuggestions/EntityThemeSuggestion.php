<?php

namespace Drupal\entity_theme_suggestions_test\Plugin\ThemeSuggestions;

use Drupal\entity_theme_suggestions\Plugin\Definition\EntityThemeSuggestionsInterface;

/**
 * Suggestion plugin used to test the main functionality.
 *
 * @EntityThemeSuggestions(
 *   id = "entity_theme_suggestions_test_plugin",
 *   entityType = "node",
 *   priority = 1
 * )
 */
class EntityThemeSuggestion implements EntityThemeSuggestionsInterface {

  /**
   * {@inheritdoc}
   */
  public function alterSuggestions(array &$suggestions, array $variables, $hook) {
    $suggestions[] = 'node_test_theme';
    return $suggestions;
  }

}
