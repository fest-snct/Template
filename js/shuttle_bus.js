// n日目のみのバス発車時刻には、時刻の最後に半角アンダーバー（_）をn個つける。
const bus_time_to_kosen = ["9:10__","9:45","10:35","11:25","12:10","12:55","13:30"];
const bus_time_to_ayasi = ["12:40","13:15","13:50","14:35","15:10","15:35_","16:10_"];
const fest_date = ["2025-10-05", "2025-10-06"];

function refresh() {
    const bus11 = document.getElementById("bus11");
    const bus12 = document.getElementById("bus12");
    const bus21 = document.getElementById("bus21");
    const bus22 = document.getElementById("bus22");
    const nowTime = new Date();
    const nt_time = nowTime.getHours()*60 + nowTime.getMinutes();

    btk= []
    is_fest = -1 // -1 開催前, 0 開催中, 1 開催後
    loop1: for (i in fest_date) {
        
        let splitted = fest_date[i].split("-");
        let ft_0 = new Date(parseInt(splitted[0]), parseInt(splitted[1])-1, parseInt(splitted[2]));
        let ft_1 = new Date(parseInt(splitted[0]), parseInt(splitted[1])-1, parseInt(splitted[2])+1);
        if (ft_0 < nowTime && nowTime < ft_1) {//今日が高専祭である
            var found = false;
            for (n in bus_time_to_kosen) {
                let cac0 = bus_time_to_kosen[n].replaceAll("_", "");
                let cac1 = cac0.split(":");
                let b_time = cac1[0]*60 + cac1[1];  
                let underbar_cnt = (bus_time_to_kosen[n].match(/_/g) || []).length;

                let if_0 = nt_time < b_time;//現在時刻よりも後
                let if_1 = underbar_cnt == i + 1 || underbar_cnt == 0;//今日のもの
                if (if_0 & if_1) {
                    found = true;
                    bus11.innerText = cac0;
                    if (n == bus_time_to_kosen.length - 1){
                        bus12.innerText = "最終便です";
                        bus12.setAttribute("class", "more");
                    } else {
                        bus12.innerText = bus_time_to_kosen[parseInt(n)+1].replaceAll("_", "");
                        bus12.setAttribute("class", "less");
                    }
                    break loop1;
                }
            }
            if (found == false) {
                bus11.innerText = "本日の運行は終了しました";
                bus11.setAttribute("class", "bustime b_thank");
                bus12.setAttribute("class", "disp_none");
            }
        }
        else if (ft_0 > nowTime && nowTime < ft_1){
            is_fest = is_fest != 0 ? -1 : 0;
        }        
    }
    btk[i]

    for (i in bus_time_to_kosen) {
    }
}
/*
Temporal.ZonedDateTime.from({
  timeZone: "Asia/Tokyo",
  year: 2025,
  month: 10,
  day: 26,
})
Temporal.Now.zonedDateTimeISO()
*/