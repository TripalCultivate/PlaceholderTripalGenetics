<?php

namespace Drupal\Tests\trpgeno_qtl\Functional;

use Drupal\Core\Url;
use Drupal\Tests\tripal_chado\Functional\ChadoTestBrowserBase;

/**
 * Simple test to ensure that main page loads with module enabled.
 *
 * @group TripGeno QTL
 * @group Installation
 */
class InstallTest extends ChadoTestBrowserBase {

  protected $defaultTheme = 'stable';

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = ['help', 'trpgeno_genetics', 'trpgeno_qtl'];

    /**
     * Tests that a specific set of pages load with a 200 response.
     */
    public function testLoad() {
      $session = $this->getSession();

      // Ensure we have an admin user.
      $user = $this->drupalCreateUser(['access administration pages', 'administer modules']);
      $this->drupalLogin($user);

      $context = '(modules installed: ' . implode(',', self::$modules) . ')';

      // Front Page.
      $this->drupalGet(Url::fromRoute('<front>'));
      $status_code = $session->getStatusCode();
      $this->assertEquals(200, $status_code, "The front page should be able to load $context.");

      // Extend Admin page.
      $this->drupalGet('admin/modules');
      $status_code = $session->getStatusCode();
      $this->assertEquals(200, $status_code, "The module install page should be able to load $context.");
      $this->assertSession()->pageTextContains('Genetic Maps + QTL');
    }

    /**
     * Tests the module overview help.
     */
    public function testHelp() {

      $session = $this->getSession();

      $some_expected_text = 'support Genetic Maps + QTL';

      // Ensure we have an admin user.
      $user = $this->drupalCreateUser(['access administration pages', 'administer modules']);
      $this->drupalLogin($user);

      $context = '(modules installed: ' . implode(',', self::$modules) . ')';

      // Call the hook to ensure it is returning text.
      $name = 'help.page.trpgeno_qtl';
      $match = $this->createStub(\Drupal\Core\Routing\RouteMatch::class);
      $output = trpgeno_qtl_help($name, $match);
      $this->assertNotEmpty($output, "The help hook should return output $context.");
      $this->assertStringContainsString($some_expected_text, $output);

      // Help Page.
      $this->drupalGet('admin/help');
      $status_code = $session->getStatusCode();
      $this->assertEquals(200, $status_code, "The admin help page should be able to load $context.");
      $this->assertSession()->pageTextContains('Genetic Maps + QTL');
      $this->drupalGet('admin/help/trpgeno_qtl');
      $status_code = $session->getStatusCode();
      $this->assertEquals(200, $status_code, "The module help page should be able to load $context.");
      $this->assertSession()->pageTextContains($some_expected_text);
    }

  }
