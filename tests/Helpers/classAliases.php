<?php

/**
 * Copyright (c) D3 Data Development (Inh. Thomas Dartsch)
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

use D3\OxidGuzzleFactory\tests\Helpers\OxidRegistryStub;

const OX_BASE_PATH = __DIR__;

class_alias(OxidRegistryStub::class, '\OxidEsales\Eshop\Core\Registry');
