/**
 * Q&A Animation
 */
export function animateQandA(threshold=0.1) {
    const questions = document.querySelectorAll("section.infos#faq details");
    const questionEntersView = new IntersectionObserver((entries) => {
        for (let i = 0; i < entries.length; i++) {
            const entry = entries[i];
            if (!entry.isIntersecting) setTimeout(() => {
                entry.target.classList.add("hidden");
            }, 100 * i);
            else setTimeout(() => {
                entry.target.classList.remove("hidden");
            }, 100 * i);
        }
    }, { threshold: threshold });
    for (const question of questions) questionEntersView.observe(question);
}