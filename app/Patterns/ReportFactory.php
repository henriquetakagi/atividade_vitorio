<?php
interface ReportFormatter { public function format(array $rows): array; }
class SalesReportFormatter implements ReportFormatter { public function format(array $rows): array { return ['titulo'=>'Relatório de vendas','registros'=>$rows]; } }
class ReportFactory { public static function create(string $type): ReportFormatter { return new SalesReportFormatter(); } }
