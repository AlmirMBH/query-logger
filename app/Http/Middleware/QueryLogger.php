<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class QueryLogger
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (config('app.env') === 'local') {
            $memoryBefore = memory_get_usage();

            DB::listen(function ($query) use (&$log, &$sqlQuery) {
                [$log, $sqlQuery] = $this->getLogAndSqlQuery($query);
            });

            $response = $next($request);

            $memoryAfter = memory_get_usage();
            $memoryUsed = $memoryAfter - $memoryBefore;

            if ($memoryUsed > 12000000 && floatval($log['Execution time']) > 20) { // 1,5MB & 20ms
                $log['Request memory'] = $this->formatUsedMemory($memoryUsed);
                Log::stack(['database_query_log'])->info(json_encode([$log, $sqlQuery]));
            }

            DB::flushQueryLog();
        } else {
            $response = $next($request);
        }

        return $response;
    }

    private function getLogAndSqlQuery(QueryExecuted $query): array
    {
        return [
            [
                'Route name' => request()->route()->getName(),
                'Execution time' => $query->time . "ms",
                'Bindings' => $query->bindings,
                'Connection name' => $query->connectionName,
                'Database' => $query->connection->getDatabaseName(),
                'Host' => $query->connection->getConfig('host'),
                'Port' => $query->connection->getConfig('port'),
                'Driver' => $query->connection->getDriverName(),
            ],
            [
                'SQL QUERY' => $query->sql
            ]
        ];
    }

    private function formatUsedMemory(int $usedMemory): string
    {
        $bytes = pow(1024, 2);

        return ($usedMemory > $bytes)
            ? round($usedMemory / $bytes, 2) . "MB"
            : round($usedMemory / 1024, 2) . "KB";
    }
}
