<?php

namespace Drupal\Tests\trpgeno_genomatrix\Functional;

use Drupal\Core\Url;
use Drupal\Tests\tripal_chado\Functional\ChadoTestBrowserBase;

/**
 * Simple test to ensure that main page loads with module enabled.
 *
 * @group TripGeno Genotype Matrix
 * @group Installation
 */
class InstallTest extends ChadoTestBrowserBase {

  protected $defaultTheme = 'stable';

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = ['help', 'trpgeno_genetics', 'trpgeno_genotypes', 'trpgeno_genomatrix'];

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
    $this->assertSession()->pageTextContains('Genotype Matrix');
  }

  /**
   * Tests the module overview help.
   */
  public function testHelp() {

    $session = $this->getSession();

    $some_expected_text = 'genetic and genotypic data';

    // Ensure we have an admin user.
    $user = $this->drupalCreateUser(['access administration pages', 'administer modules']);
    $this->drupalLogin($user);

    $context = '(modules installed: ' . implode(',', self::$modules) . ')';

    // Call the hook to ensure it is returning text.
    $name = 'help.page.trpgeno_genomatrix';
    $match = $this->createStub(\Drupal\Core\Routing\RouteMatch::class);
    $output = trpgeno_genetics_help($name, $match);
    $this->assertNotEmpty($output, "The help hook should return output $context.");
    $this->assertStringContainsString($some_expected_text, $output);

    // Help Page.
    $this->drupalGet('admin/help');
    $status_code = $session->getStatusCode();
    $this->assertEquals(200, $status_code, "The admin help page should be able to load $context.");
    $this->assertSession()->pageTextContains('Genotype Matrix');
    $this->drupalGet('admin/help/trpgeno_genomatrix');
    $status_code = $session->getStatusCode();
    $this->assertEquals(200, $status_code, "The module help page should be able to load $context.");
    $this->assertSession()->pageTextContains($some_expected_text);
  }

}
