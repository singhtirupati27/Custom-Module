<?php

namespace Drupal\movie_module\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\movie_module\AwardWinningMovieInterface;

/**
 * Defines the award winning movie config entity type.
 *
 * @ConfigEntityType(
 *   id = "award_winning_movie",
 *   label = @Translation("Award Winning Movie"),
 *   label_collection = @Translation("Award Winning Movies"),
 *   label_singular = @Translation("award winning movie"),
 *   label_plural = @Translation("award winning movies"),
 *   label_count = @PluralTranslation(
 *     singular = "@count award winning movie",
 *     plural = "@count award winning movies",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\movie_module\AwardWinningMovieListBuilder",
 *     "form" = {
 *       "add" = "Drupal\movie_module\Form\AwardWinningMovieForm",
 *       "edit" = "Drupal\movie_module\Form\AwardWinningMovieForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     }
 *   },
 *   config_prefix = "award_winning_movie",
 *   admin_permission = "administer award_winning_movie",
 *   links = {
 *     "collection" = "/admin/structure/award-winning-movie",
 *     "add-form" = "/admin/structure/award-winning-movie/add",
 *     "edit-form" = "/admin/structure/award-winning-movie/{award_winning_movie}",
 *     "delete-form" = "/admin/structure/award-winning-movie/{award_winning_movie}/delete"
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *     "movie_year" = "movie_year"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *     "movie_year"
 *   }
 * )
 */
class AwardWinningMovie extends ConfigEntityBase implements AwardWinningMovieInterface {

  /**
   * The award winning movie ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The award winning movie label.
   *
   * @var string
   */
  protected $label;

  /**
   * The award_winning_movie description.
   *
   * @var string
   */
  protected $description;

  /**
   * The award_winning_movie year.
   */
  protected $movieYear;

}
