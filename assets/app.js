import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import './vendor/cally/cally.index.js';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

const range = document.getElementById("myRange");
const output = document.getElementById("output");

/**
 * ===========================
 *          Option 1
 * ===========================
 */

// ⚡ On définit la fonction isDateDisallowed

if (range !== null) {
    range.isDateDisallowed = (date) => {
        const day = date.getDay();
        console.log('day', day)
        // Interdire samedi (6) et dimanche (0)
        return day === 0 || day === 6;
    };
}

/**
 * ===========================
 *          Option 2
 * ===========================
 */


if (range !== null) {

    // ⚡ On capte la valeur quand on sélectionne
    range.addEventListener("change", (e) => {
        output.textContent = e.target.value;
    });

    range.isDateDisallowed = (date) => {
    const today = new Date();
    today.setHours(0,0,0,0); // reset heures
    return date < today; // interdit toute date avant aujourd’hui
    }

    range.isDateDisallowed = (date) => {
        const dateReservation = new Date('August 26, 2025');
        // const day = date.getDay()
        return dateReservation.toDateString() === date.toDateString()
    }
}

/**
 * ===========================
 *          Option 3
 * ===========================
 */

class DateBlocked {
    constructor(start, end) {
        this.start = start
        this.end = end
    }
}

function rangeDatesToBlock(date, start, end) {
    start.setHours(0,0,0,0)
    end.setHours(0,0,0,0)

    return date >= start && date <= end
}

function getBaseUrl() {
    return window.location.origin
}

const cal = document.getElementById("reservationCalendar");
const output02 = document.getElementById("output");

// Plage bloquée : du 1er au 14 août 2025
const dateBlocked = new DateBlocked(new Date(2025, 7, 1), new Date(2025, 7, 14))

// Plage disponible : uniquement 15 et 16 août 2025
const dateBlocked02 = new DateBlocked(new Date(2025, 7, 17), new Date(2025, 7, 19))

const datesBlocked = [
    dateBlocked,
    dateBlocked02
]

// Remplacée par l'option 4
/*
cal.isDateDisallowed = (date) => {
    date.setHours(0,0,0,0)
    return datesBlocked.some(dateBlocked => rangeDatesToBlock(date, dateBlocked.start, dateBlocked.end))
};
*/

if (cal !== null) {
    cal.addEventListener("change", (e) => {
        output02.textContent = e.target.value;
    });
}

/**
 * ===========================
 *          Option 4
 * ===========================
 */


if (cal !== null) {
    const res = fetch(`${getBaseUrl()}/dates-blocked`)
    
    res
        .then(respAPI => respAPI.json() )
        .then(dateBlockedAPI => {
            const datesBlockedFormatted = dateBlockedAPI.map(date => new DateBlocked(new Date(date.start), new Date(date.end)))
    
            cal.isDateDisallowed = (date) => {
                date.setHours(0,0,0,0)
                return datesBlockedFormatted.some(dateBlocked => rangeDatesToBlock(date, dateBlocked.start, dateBlocked.end))
            };
        })
}    


/**
 * ===========================
 *          From form
 * ===========================
 */

const calendarForm = document.getElementById('reservationFromCalendar')

if (calendarForm !== null) {
    const response = fetch(`${getBaseUrl()}/dates-blocked`)

    response
        .then(respAPI => respAPI.json() )
        .then(dateBlockedAPI => {
            const datesBlockedFormatted = dateBlockedAPI.map(date => new DateBlocked(new Date(date.start), new Date(date.end)))
    
            calendarForm.isDateDisallowed = (date) => {
                date.setHours(0,0,0,0)
                return datesBlockedFormatted.some(dateBlocked => rangeDatesToBlock(date, dateBlocked.start, dateBlocked.end))
            };
        })
    
    calendarForm.addEventListener('change', (e) => {
        const dateRangeSelected = e.target.value
        const dateRangeSplitted = dateRangeSelected.split('/') // 2025-09-25/2025-09-26
        const dateStart = dateRangeSplitted[0]
        const dateEnd = dateRangeSplitted[1]
    
        const dateStartEl = document.querySelector('.dateStartForm')
        const dateEndEl = document.querySelector('.dateEndForm')
    
        dateStartEl.value = dateStart
        dateEndEl.value = dateEnd
    })
}
