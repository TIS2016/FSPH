<div class="row rp-box js__runner-box--{{ $runner->id }} rp-box--runner">
    <div class="col-xs-12 rp-box__row--header {{ $runner->runner___is_winner ? "runners__header--gold" : "runners__header--standard" }}">
        <div class="rp-box__header--name">
            {{ $runner->users___name }}
        </div>
        <div class="rp-box__header--distance_text">
            {{ $runner->total_distance / 1000 }} km
        </div>
    </div>
    <div class="col-xs-12 rp-box__row--description">
        <div class="runner__description--text">
            Sa prihlásil dňa <strong>{{ date("d. m. Y", strtotime($runner->start)) }}</strong> <br />
            @if($runner->runner___is_winner)
                Do cieľa dobehol dňa <strong>{{ date("d. m. Y", strtotime($runner->finish)) }}</strong>
            @else
                A ešte stále beží...
            @endif
        </div>
        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="avatar" class="runner__description--img" />

        <div class="runner__description--text col-xs-12 js-table-{{ $runner->id }}">
            <table class="table--running-data hidden-xs">
                <tr>
                    <th>Dátum záznamu</th>
                    <th>Odbehnutá vzdialenosť (m)</th>
                    <th>:&nbsp;)</th>
                </tr>

                @foreach($running_datas[$runner->user_id] as $running_data)
                    <tr>
                        <td>{{ date("d. m. Y", strtotime($running_data->date)) }}</td>
                        <td>{{ $running_data->distance }}</td>
                        <td class="td--running-data-mood-{{ $running_data->mood }}">
                            @if($running_data->mood == 1)
                                :&nbsp;)
                            @elseif($running_data->mood == 2)
                                :&nbsp;]
                            @elseif($running_data->mood == 3)
                                :&nbsp;|
                            @elseif($running_data->mood == 4)
                                :&nbsp;(
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>

            <table class="table--running-data visible-xs">
                <tr>
                    <th colspan="2">Záznam</th>
                </tr>

                @foreach($running_datas[$runner->user_id] as $running_data)
                    <tr class="td--running-data-mood-{{ $running_data->mood }}">
                        <td>{{ date("d. m. Y", strtotime($running_data->date)) }}</td>
                        <td>{{ $running_data->distance }}m</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".js__runner-box--{{ $runner->id }} .rp-box__row--description").hide();

        $(".js__runner-box--{{ $runner->id }} .js-table-{{ $runner->id }}").hide();

        $(".js__runner-box--{{ $runner->id }}").hover(function () {
            $(this).find(".rp-box__row--description").show(500);
        }, function () {
//            $(this).find(".rp-box__row--description").hide(500);
        });

        $(".js__runner-box--{{ $runner->id }}").click(function () {
            $(this).find(".js-table-{{ $runner->id }}").toggle(500);
        });
    });
</script>

