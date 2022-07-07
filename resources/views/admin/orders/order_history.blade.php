<div class="tab-pane fade" id="order_history_tab" role="tab-panel">
    <div class="d-flex flex-column gap-7 gap-lg-10">
        <div class="card card-flush py-4 flex-row-fluid">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ __('Order History') }}</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-100px">{{ __('Date Added') }}</th>
                                <th class="min-w-175px">{{ __('Comment') }}</th>
                                <th class="min-w-70px">{{ __('Order Status') }}</th>
                                <th class="min-w-150px">{{ __('User') }}</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600">
                            @foreach ($order->History as $history)
                                @php
                                    $created = new DateTime($history->created_at);
                                @endphp
                                <tr>
                                    <td>{{ $created->format('d/m/Y H:i') }}</td>
                                    <td>{{ $history->Comment }}</td>
                                    <td>
                                        <div class="badge badge-light-{{ $history->Color }}">
                                            {{ __($history->StatusName) }}</div>
                                    </td>
                                    <td>{{ $history->UserName }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="card card-flush py-4 flex-row-fluid">
            <div class="card-header">
                <div class="card-title">
                    <h2>Order Data</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5">
                        <tbody class="fw-bold text-gray-600">
                            <tr>
                                <td class="text-muted">IP Address</td>
                                <td class="fw-bolder text-end">172.68.221.26</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Forwarded IP</td>
                                <td class="fw-bolder text-end">89.201.163.49</td>
                            </tr>
                            <tr>
                                <td class="text-muted">User Agent</td>
                                <td class="fw-bolder text-end">Mozilla/5.0 (Windows NT 10.0; Win64;
                                    x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110
                                    Safari/537.36</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Accept Language</td>
                                <td class="fw-bolder text-end">en-GB,en-US;q=0.9,en;q=0.8</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>
</div>
