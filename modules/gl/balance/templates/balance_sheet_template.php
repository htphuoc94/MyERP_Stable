<!--<h1 class="text-center"><?php // echo $custom_template_name . ' | ' . gettext('CONSOLIDATED BALANCE SHEETS'); ?></h1>-->
<h2 class="text-center"><?php echo $org_name ?></h2>
<table class ="balance_sheet table table-bordered simple_table">
 <thead> 
  <tr>
    <th rowspan="2" style="text-align: center;"><?php echo gettext('Account'); ?></th>
    <th rowspan="2" style="text-align: center;"><?php echo gettext('Account Name'); ?></th>
    <th colspan="2" style="text-align: center;"><?php echo gettext('Beginning'); ?></th>
    <th colspan="4" style="text-align: center;"><?php echo gettext('Incurred'); ?></th>
    <th colspan="2" style="text-align: center;"><?php echo gettext('End Of Period'); ?></th>
<!--   <th>As of <?php // echo $current_period; ?></th>
   <th>As of <?php // echo $last_period; ?></th>-->
  </tr>
  <tr>
    <th><?php echo gettext('Debit'); ?></th>
    <th><?php echo gettext('Credit'); ?></th>
    <th><?php echo gettext('Debit'); ?></th>
    <th><?php echo gettext('Credit'); ?></th>
    <th><?php echo gettext('Accumulated Debit'); ?></th>
    <th><?php echo gettext('Accumulated Credit'); ?></th>
    <th><?php echo gettext('Debit'); ?></th>
    <th><?php echo gettext('Credit'); ?></th>
<!--   <th>As of <?php // echo $current_period; ?></th>
   <th>As of <?php // echo $last_period; ?></th>-->
  </tr>
 </thead>
 <tbody>
  <tr class="label_one">
   <td><?php echo gettext('ASSETS'); ?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <?php
  $coa = new coa();
  $coa->coa_id = 1;
  $coa->only_parent = true;
  $coa->account_qualifier = 'A';
  $total_asset = 0;

  $gbv = new gl_balance_v();
  $gbv->period_id_for_fs = $period_id;
  $gbv->account_code_low_limit = $coa->field4_low = '1';
  $gbv->account_code_upper_limit = $coa->field4_high = '104499';
  $all_asset_parent_segments = $coa->findAll_accounts_from_coaId();
  if (!empty($all_asset_parent_segments)) {
   $all_asset_parent_segments_ai = new ArrayIterator($all_asset_parent_segments);
  }
  $gbv->parent_segments_arrayIterator = $all_asset_parent_segments_ai;
//  $gbv->fs_detail_data = 1;
  $ret_a = $gbv->financeStatement_showBalance();
  echo $ret_a['statement'];
  $sum_amount_cash_eq = $ret_a['sum'];
  $total_asset += $sum_amount_cash_eq;
  ?>
  <tr class="label_three">
    <td colspan="2" style="text-align: right;"><?php echo gettext('Total Cash & Receivables'); ?></td>
   <td colspan="8"><?php echo $sum_amount_cash_eq ?></td>
  </tr>

  <?php
  $gbv->account_code_low_limit = $coa->field4_low = '104500';
  $gbv->account_code_upper_limit = $coa->field4_high = '105499';
  $all_asset_parent_segments = $coa->findAll_accounts_from_coaId();
  if (!empty($all_asset_parent_segments)) {
   $all_asset_parent_segments_ai = new ArrayIterator($all_asset_parent_segments);
  }
  $gbv->parent_segments_arrayIterator = $all_asset_parent_segments_ai;
  $ret_a = $gbv->financeStatement_showBalance();
  echo $ret_a['statement'];
  $sum_amount_gi = $ret_a['sum'];
  $total_asset += $sum_amount_gi;
  ?>
  <tr class="label_three">
   <td colspan="2" style="text-align: right;">Gross Inventory</td>
   <td colspan="8"><?php echo ($sum_amount_gi) ?></td>
  </tr>

  <?php
  $gbv->account_code_low_limit = $coa->field4_low = '105500';
  $gbv->account_code_upper_limit = $coa->field4_high = '105599';
  $all_asset_parent_segments = $coa->findAll_accounts_from_coaId();
  if (!empty($all_asset_parent_segments)) {
   $all_asset_parent_segments_ai = new ArrayIterator($all_asset_parent_segments);
  }
  $gbv->parent_segments_arrayIterator = $all_asset_parent_segments_ai;
  $ret_a = $gbv->financeStatement_showBalance();
  echo $ret_a['statement'];
  $sum_amount_reserve = $ret_a['sum'];
  $total_asset += $sum_amount_reserve;
  ?>
  <tr class="label_three">
   <td colspan="2" style="text-align: right;"><?php echo gettext('Net Inventory'); ?></td>
   <td colspan="8"><?php echo ($sum_amount_gi + $sum_amount_reserve ) ?></td>
  </tr>
  <?php
  $gbv->account_code_low_limit = $coa->field4_low = '106000';
  $gbv->account_code_upper_limit = $coa->field4_high = '109999';
  $all_asset_parent_segments = $coa->findAll_accounts_from_coaId();
  if (!empty($all_asset_parent_segments)) {
   $all_asset_parent_segments_ai = new ArrayIterator($all_asset_parent_segments);
  }

  $gbv->parent_segments_arrayIterator = $all_asset_parent_segments_ai;
  $ret_a = $gbv->financeStatement_showBalance();
  $sum_pre_paid_exp = $ret_a['sum'];
  $total_asset += $sum_pre_paid_exp;
  echo $ret_a['statement'];
  ?>
  <tr class="label_two with_data">
   <td colspan="2" style="text-align: right;"><?php echo gettext('Total Current Assets'); ?></td>
   <td colspan="8"><?php echo $total_asset; ?></td>
  </tr>


  <?php
  $gbv->account_code_low_limit = $coa->field4_low = '108000';
  $gbv->account_code_upper_limit = $coa->field4_high = '199999';
  $all_asset_parent_segments = $coa->findAll_accounts_from_coaId();
  if (!empty($all_asset_parent_segments)) {
   $all_asset_parent_segments_ai = new ArrayIterator($all_asset_parent_segments);
  }
  $gbv->parent_segments_arrayIterator = $all_asset_parent_segments_ai;
  $ret_a = $gbv->financeStatement_showBalance();
  $sum_nonc_asset = $ret_a['sum'];
  $total_asset += $sum_nonc_asset;
  echo $ret_a['statement'];
  ?>
  <tr class="label_two with_data">
   <td colspan="2" style="text-align: right;"><?php echo gettext('Total Non Current Assets'); ?></td>
   <td colspan="8"><?php echo $sum_nonc_asset; ?></td>
  </tr>

  <tr class="label_one with_data">
   <td colspan="2" style="text-align: right;"><?php echo gettext('TOTAL ASSETS'); ?></td>
   <td colspan="8"><?php echo ($total_asset); ?></td>
  </tr>

  <tr class="label_one">
      <td colspan="2" style="text-align: right;"><?php echo gettext('LIABILITIES & EQUITY'); ?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>

  <?php
  $coa = new coa();
  $coa->coa_id = 1;
  $coa->only_parent = true;
  $coa->account_qualifier = 'L';
  $liability_sum = 0;
  $gbv->account_code_low_limit = $coa->field4_low = '200000';
  $gbv->account_code_upper_limit = $coa->field4_high = '249999';
  $all_asset_parent_segments = $coa->findAll_accounts_from_coaId();
  if (!empty($all_asset_parent_segments)) {
   $all_asset_parent_segments_ai = new ArrayIterator($all_asset_parent_segments);
  }
  $gbv->parent_segments_arrayIterator = $all_asset_parent_segments_ai;
  $ret_a = $gbv->financeStatement_showBalance();
  echo $ret_a['statement'];
  $liability_sum += $ret_a['sum'];
  ?>
  <tr class="label_two with_data">
   <td colspan="2" style="text-align: right;"><?php echo gettext('Total Current Liabilities'); ?></td>
   <td colspan="8"><?php echo $ret_a['sum']; ?></td>
  </tr>

  <?php
  $gbv->account_code_low_limit = $coa->field4_low = '250000';
  $gbv->account_code_upper_limit = $coa->field4_high = '299999';
  $all_asset_parent_segments = $coa->findAll_accounts_from_coaId();
  if (!empty($all_asset_parent_segments)) {
   $all_asset_parent_segments_ai = new ArrayIterator($all_asset_parent_segments);
  }
  $gbv->parent_segments_arrayIterator = $all_asset_parent_segments_ai;
  $ret_a = $gbv->financeStatement_showBalance();
  echo $ret_a['statement'];
  $liability_sum += $ret_a['sum'];
  ?>
  <tr class="label_two with_data">
   <td colspan="2" style="text-align: right;"><?php echo gettext('Total Long-Term Liabilities'); ?></td>
   <td colspan="8"><?php echo $ret_a['sum']; ?></td>
  </tr>
  <tr class="label_two with_data">
   <td colspan="2" style="text-align: right;"><?php echo gettext('Total Liabilities'); ?></td>
   <td colspan="8"><?php echo $liability_sum; ?></td>
  </tr>

  <?php
  $coa = new coa();
  if (!empty($_GET['org_id'][0])) {
    $org_id = $_GET['org_id'][0];
   $org_fin_details = org::find_financial_details_from_orgId($org_id);
   if (!empty($org_fin_details)) {
    $coa_id = $org_fin_details->coa_id;
   }
  }

  if (empty($coa_id)) {
   $coa_id = 1;
  }
  $coa->coa_id = $coa_id;
  $equity_sum = 0;
  $coa->only_parent = true;
  $coa->account_qualifier = 'E';
  $gbv->account_code_low_limit = $coa->field4_low = '300000';
  $gbv->account_code_upper_limit = $coa->field4_high = '399999';
  $all_asset_parent_segments = $coa->findAll_accounts_from_coaId();
  if (!empty($all_asset_parent_segments)) {
   $all_asset_parent_segments_ai = new ArrayIterator($all_asset_parent_segments);
  }
  $gbv->parent_segments_arrayIterator = $all_asset_parent_segments_ai;
  $ret_a = $gbv->financeStatement_showBalance();
  echo $ret_a['statement'];
  $equity_sum += $ret_a['sum'];
  ?>

  <?php
  $ret_expected = (- $total_asset ) - $liability_sum - $equity_sum;
  if (!empty(($ret_expected))) {
   echo '<tr class="label_two with_data">';
   echo '<td colspan="2" style="text-align: right;">Retained Earnings - Expected</td>';
   echo "<td colspan='8'>$ret_expected</td>";
   echo '</tr>';
  }
  ?>

  <tr class="label_two with_data">
   <td colspan="2" style="text-align: right;"><?php echo gettext('Total Shareholders Equity'); ?></td>
   <td colspan="8"><?php echo ($ret_a['sum'] + $ret_expected); ?></td>
  </tr>

  <tr class="label_one with_data">
   <td colspan="2" style="text-align: right;"><?php echo gettext('TOTAL LIABILITIES & EQUITY'); ?></td>
   <td colspan="8"><?php echo ($liability_sum + $equity_sum + $ret_expected ); ?></td>
  </tr>
 </tbody>
</table>