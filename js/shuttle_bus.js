// n日目のみのバス発車時刻には、時刻の最後に半角アンダーバー（_）をn個つける。
//const bus_time_to_kosen = ["9:10__", "9:45", "10:35", "11:25", "12:10", "12:55", "13:30"];
const bus_time_to_kosen = ["22:12","22:09_","22:10__","22:11", "22:17_"];
//const bus_time_to_ayasi = ["12:40", "13:15", "13:50", "14:35", "15:10", "15:35_", "16:10_"];
const bus_time_to_ayasi = ["22:12","22:09_","22:10__","22:11", "22:17_"];
//const fest_date = ["2025-10-25", "2025-10-26"];
const fest_date = ["2025-10-06", "2025-10-07"];
let interval;
const bus_times = [bus_time_to_kosen, bus_time_to_ayasi];

function refresh() {
    //console.log("print");
    // 定義
    const bus11 = document.getElementById("bus11");
    const bus12 = document.getElementById("bus12");
    const bus21 = document.getElementById("bus21");
    const bus22 = document.getElementById("bus22");
    const bus_disps = [[bus11, bus12], [bus21, bus22]];
    const wrp = document.getElementById("wrp");
    const nb_title = document.getElementById("nxt_bus_t");
    const bustime = document.getElementById("bustime_notice");
    let nowTime, nt_date, nt_time;
    // 時刻取得（Temporal対応済）
    if (typeof Temporal !== 'undefined') {
        const _nowTime = Temporal.Now.zonedDateTimeISO();
        nowTime = _nowTime.epochMilliseconds;//比較可能な現在時刻
        nt_time = _nowTime.hour * 60 + _nowTime.minute;//今の時間を分で表現
        nt_date = _nowTime.year + "-" + _nowTime.month.toString().padStart(2, "0") + "-" + _nowTime.day.toString().padStart(2, "0");//ISO-8601形式の日付
    } else {
        nowTime = new Date();
        nt_time = nowTime.getHours() * 60 + nowTime.getMinutes();
        nt_date = nowTime.getFullYear().toString().padStart(4, "0") + "-" + (nowTime.getMonth() + 1).toString().padStart(2, "0") + "-" + nowTime.getDate().toString().padStart(2, "0");
    }
    // 開催日の配列に今日の日付が含まれるか調べる。0:期間外、1:1日目、2:2日目
    const today = fest_date.indexOf(nt_date);
    
    // 今が開催後なのか開催前なのかを保持する変数。-1 開催前, 0 開催中, 1 開催後
    is_fest = -1;
    for (i in fest_date) {//
        // 高専祭の開催日の日付の変数をつくる
        let splitted = fest_date[i].split("-");
        let ft_0, ft_1;
        if (typeof Temporal !== 'undefined') {
            ft_0 = Temporal.ZonedDateTime.from({ timeZone: "Asia/Tokyo", year: splitted[0], month: splitted[1], day: splitted[2] }).epochMilliseconds;
            ft_1 = Temporal.ZonedDateTime.from({ timeZone: "Asia/Tokyo", year: splitted[0], month: splitted[1], day: splitted[2] + 1 }).epochMilliseconds;
        } else {
            ft_0 = new Date(parseInt(splitted[0]), parseInt(splitted[1]) - 1, parseInt(splitted[2]));
            ft_1 = new Date(parseInt(splitted[0]), parseInt(splitted[1]) - 1, parseInt(splitted[2]) + 1);
        }
        // 高専祭当日の日付の配列に、今日の日付が入っていれば`today - 1`が-1ではなくなるのでiの値がいずれかのときに通れる
        if (today == i) {
        //if (today != -1){
            wrp.removeAttribute("class");
            bustime.setAttribute("class", "disp_none");
            is_fest = 0;
            // 愛子行・高専行を配列にしてforを使えるようにしたからこうなってる
            for (l in bus_times) {
                var found0 = false;
                // バスの時間に対しての処理
                for (n in bus_times[l]) {
                    let cac0 = bus_times[l][n].replaceAll("_", "");
                    let cac1 = cac0.split(":");
                    let b_time = parseInt(cac1[0]) * 60 + parseInt(cac1[1]);
                    let underbar_cnt0 = (bus_times[l][n].match(/_/g) || []).length;
                    let if_00 = nt_time < b_time;// 今確認しているものが現在時刻よりも後
                    let if_01 = underbar_cnt0 == parseInt(i) + 1 || underbar_cnt0 == 0;// アンダーバーの数で何日目のものか判別
                    if (if_00 && if_01) {
                        // 大きいほうのテキストをセット
                        found0 = true;
                        bus_disps[l][0].innerText = cac0;
                        bus_disps[l][0].setAttribute("class", "bustime");
                        /*if (n == bus_times[l].length - 1) {
                            bus_disps[l][1].innerText = "最終便です";
                            bus_disps[l][1].setAttribute("class", "more");
                        } else {*/
                            let found3 = false;
                            for (let m = parseInt(n) + 1; m < bus_times[l].length; m++) {
                                let underbar_cnt1 = (bus_times[l][m].match(/_/g) || []).length;
                                let if_10 = underbar_cnt1 == today + 1;
                                let if_11 = underbar_cnt1 == 0;
                                if (if_10 || if_11) {
                                    // 小さいほうのテキストをセット
                                    found3 = true;
                                    bus_disps[l][1].innerText = bus_times[l][m].replaceAll("_", "");
                                    bus_disps[l][1].setAttribute("class", "less");
                                    break;
                                }
                            }
                            if (found3 == false) {
                                // さらに次のバスが見つからなかった場合はお知らせ
                                bus_disps[l][1].innerText = "最終便です";
                                bus_disps[l][1].setAttribute("class", "more");
                            }
                        //}
                        break;
                    }
                }
                if (found0 == false) {
                    // 次のバスが見つからなかった場合はお知らせ
                    bus_disps[l][0].innerText = "本日の運行は\n終了しました";
                    bus_disps[l][0].setAttribute("class", "bustime b_thank");
                    bus_disps[l][1].setAttribute("class", "disp_none");
                }
            }
        
        } else if (ft_0 > nowTime && nowTime < ft_1) {
            is_fest = is_fest != 0 ? -1 : 0;
        } else if (ft_0 < nowTime && nowTime > ft_1) {
            is_fest = is_fest != 0 ? 1 : 0;
        }
    }//
    if (is_fest == -1) {
        wrp.setAttribute("class", "disp_none");
        bustime.innerText = "「次のシャトルバス」は高専祭当日のみご利用いただけます。";
        bustime.removeAttribute("class");
    } else if (is_fest == 1) {
        wrp.setAttribute("class", "disp_none");
        nb_title.setAttribute("class", "disp_none");
        bustime.setAttribute("class", "disp_none");
        clearInterval(interval);
        //bustime.innerText = `高専祭${fest_date[0].split("-")[0]}へご来場いただき、ありがとうございました。`;
        //bustime.removeAttribute("class");
    }
}
document.addEventListener("DOMContentLoaded", function () {
    interval = setInterval(refresh, 1000);
});