<!-- ═══════════════════════════════════════════════════════
     BOOK AI MODAL — ShelfSync AI Assistant
     ═══════════════════════════════════════════════════════ -->
<div id="bookAiOverlay" class="bai-overlay" onclick="BookAI.close()">
    <div class="bai-modal" onclick="event.stopPropagation()">

        <!-- Header -->
        <div class="bai-header">
            <div class="bai-brand">
                <span class="bai-brand-icon"><i class="fas fa-brain"></i></span>
                <span>ShelfSync <strong>AI</strong></span>
            </div>
            <button class="bai-close" onclick="BookAI.close()" title="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Info Section -->
        <div class="bai-info" id="baiInfo">
            <!-- Loading skeleton -->
            <div class="bai-skeleton" id="baiSkeleton">
                <div class="bai-skel-row">
                    <div class="bai-skel-cover shimmer"></div>
                    <div class="bai-skel-meta">
                        <div class="shimmer" style="width:80%;height:18px;border-radius:6px;margin-bottom:10px;"></div>
                        <div class="shimmer" style="width:55%;height:13px;border-radius:6px;margin-bottom:8px;"></div>
                        <div class="shimmer" style="width:40%;height:13px;border-radius:6px;margin-bottom:14px;"></div>
                        <div style="display:flex;gap:6px;">
                            <div class="shimmer" style="width:56px;height:22px;border-radius:20px;"></div>
                            <div class="shimmer" style="width:48px;height:22px;border-radius:20px;"></div>
                            <div class="shimmer" style="width:64px;height:22px;border-radius:20px;"></div>
                        </div>
                    </div>
                </div>
                <div class="shimmer" style="width:100%;height:14px;border-radius:6px;margin-top:20px;"></div>
                <div class="shimmer" style="width:90%;height:14px;border-radius:6px;margin-top:8px;"></div>
                <div class="shimmer" style="width:95%;height:14px;border-radius:6px;margin-top:8px;"></div>
            </div>

            <!-- Populated info (hidden initially) -->
            <div class="bai-info-content" id="baiInfoContent" style="display:none;">
                <div class="bai-book-row">
                    <img id="baiCover" class="bai-cover" src="" alt="Cover">
                    <div class="bai-meta">
                        <h2 class="bai-title" id="baiTitle"></h2>
                        <div class="bai-author" id="baiAuthor"></div>
                        <div class="bai-publisher" id="baiPublisher"></div>
                        <div class="bai-pills" id="baiPills"></div>
                    </div>
                </div>

                <div class="bai-section">
                    <div class="bai-section-label"><i class="fas fa-book-open"></i> About This Book</div>
                    <p class="bai-text" id="baiDescription"></p>
                </div>

                <div class="bai-section">
                    <div class="bai-section-label"><i class="fas fa-lightbulb"></i> What This Book Tells Us</div>
                    <p class="bai-text" id="baiSummary"></p>
                </div>
            </div>

            <!-- Error state -->
            <div class="bai-error" id="baiError" style="display:none;">
                <i class="fas fa-exclamation-triangle"></i>
                <p>Couldn't reach the AI service right now.</p>
                <button class="bai-retry-btn" onclick="BookAI.retryInfo()">Try Again</button>
            </div>
        </div>

        <!-- Divider -->
        <div class="bai-divider"></div>

        <!-- Chat Section -->
        <div class="bai-chat-header">
            <i class="fas fa-comment-dots"></i>
            <span>Ask about this book</span>
            <button class="bai-clear-chat" id="baiClearChat" onclick="BookAI.clearChat()" title="Clear chat">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
        <div class="bai-chat" id="baiChat">
            <div class="bai-msg bai-msg-ai">
                <div class="bai-msg-avatar"><i class="fas fa-robot"></i></div>
                <div class="bai-msg-bubble">Ask me anything about this book.</div>
            </div>
        </div>

        <!-- Chat Input -->
        <div class="bai-input-wrap">
            <input type="text" id="baiInput" class="bai-input" placeholder="Ask about this book..." autocomplete="off"
                   onkeydown="if(event.key==='Enter')BookAI.send()">
            <button class="bai-send" id="baiSend" onclick="BookAI.send()">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>

    </div>
</div>

<style>
/* ── Overlay ── */
.bai-overlay {
    position: fixed; inset: 0; z-index: 10000;
    background: rgba(0,0,0,0.65);
    backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);
    display: flex; align-items: center; justify-content: center;
    padding: 20px;
    opacity: 0; visibility: hidden;
    transition: opacity 0.3s, visibility 0.3s;
}
.bai-overlay.open { opacity: 1; visibility: visible; }

/* ── Modal ── */
.bai-modal {
    width: 100%; max-width: 520px;
    max-height: 88vh;
    background: rgba(12,12,18,0.97);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 20px;
    display: flex; flex-direction: column;
    transform: translateY(20px) scale(0.97);
    transition: transform 0.35s cubic-bezier(.16,1,.3,1);
    box-shadow: 0 30px 80px rgba(0,0,0,0.7), 0 0 0 1px rgba(255,255,255,0.03) inset;
    overflow: hidden;
}
.bai-overlay.open .bai-modal { transform: translateY(0) scale(1); }

/* ── Header ── */
.bai-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.bai-brand {
    display: flex; align-items: center; gap: 8px;
    font-size: 0.88rem; color: rgba(255,255,255,0.7); font-weight: 500;
}
.bai-brand strong { color: var(--ss-cyan); font-weight: 700; }
.bai-brand-icon { font-size: 0.85rem; color: var(--ss-cyan); }
.bai-close {
    width: 32px; height: 32px; border-radius: 8px;
    background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.5); font-size: 0.8rem;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.2s;
}
.bai-close:hover { background: rgba(244,63,94,0.15); color: var(--ss-rose); border-color: rgba(244,63,94,0.2); }

/* ── Info Section ── */
.bai-info { padding: 20px; overflow-y: auto; max-height: 320px; }
.bai-book-row { display: flex; gap: 16px; margin-bottom: 18px; }
.bai-cover {
    width: 90px; height: 130px; border-radius: 10px;
    object-fit: cover; flex-shrink: 0;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.06);
}
.bai-meta { flex: 1; min-width: 0; }
.bai-title {
    font-size: 1.1rem; font-weight: 700; color: #fff;
    margin: 0 0 6px; line-height: 1.3;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}
.bai-author { font-size: 0.82rem; color: var(--ss-cyan); margin-bottom: 3px; font-weight: 500; }
.bai-publisher { font-size: 0.75rem; color: rgba(255,255,255,0.4); margin-bottom: 10px; }
.bai-pills { display: flex; flex-wrap: wrap; gap: 5px; }
.bai-pill {
    font-size: 0.65rem; font-weight: 600; padding: 3px 10px;
    border-radius: 20px; letter-spacing: 0.02em;
    background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.55);
    border: 1px solid rgba(255,255,255,0.06);
}

.bai-section { margin-bottom: 14px; }
.bai-section-label {
    font-size: 0.68rem; font-weight: 700; color: var(--ss-cyan);
    letter-spacing: 0.08em; text-transform: uppercase;
    margin-bottom: 6px; display: flex; align-items: center; gap: 6px;
}
.bai-text {
    font-size: 0.82rem; color: rgba(255,255,255,0.65);
    line-height: 1.65; margin: 0;
}

/* ── Skeleton ── */
.bai-skel-row { display: flex; gap: 16px; }
.bai-skel-cover { width: 90px; height: 130px; border-radius: 10px; flex-shrink: 0; }
.bai-skel-meta { flex: 1; }
.shimmer {
    background: linear-gradient(90deg, rgba(255,255,255,0.03) 30%, rgba(255,255,255,0.07) 50%, rgba(255,255,255,0.03) 70%);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
}
@keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

/* ── Error ── */
.bai-error { text-align: center; padding: 30px 0; color: var(--ss-text-3); }
.bai-error i { font-size: 1.8rem; color: var(--ss-amber); margin-bottom: 10px; display: block; }
.bai-error p { font-size: 0.85rem; margin-bottom: 14px; }
.bai-retry-btn {
    background: rgba(0,212,255,0.1); color: var(--ss-cyan);
    border: 1px solid rgba(0,212,255,0.2); border-radius: 8px;
    padding: 6px 18px; font-size: 0.78rem; font-weight: 600; cursor: pointer;
    transition: all 0.2s;
}
.bai-retry-btn:hover { background: rgba(0,212,255,0.18); }

/* ── Divider ── */
.bai-divider { height: 1px; background: rgba(255,255,255,0.05); margin: 0 20px; }

/* ── Chat Header ── */
.bai-chat-header {
    display: flex; align-items: center; gap: 8px;
    padding: 12px 20px 6px; font-size: 0.72rem; font-weight: 600;
    color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 0.06em;
}
.bai-chat-header i { color: var(--ss-cyan); }
.bai-clear-chat {
    margin-left: auto; background: none; border: none; color: rgba(255,255,255,0.25);
    cursor: pointer; font-size: 0.7rem; padding: 4px; transition: color 0.2s;
}
.bai-clear-chat:hover { color: var(--ss-rose); }

/* ── Chat Messages ── */
.bai-chat {
    padding: 8px 20px 12px;
    overflow-y: auto; max-height: 200px;
    display: flex; flex-direction: column; gap: 10px;
    scroll-behavior: smooth;
}
.bai-msg { display: flex; gap: 8px; align-items: flex-start; animation: msgFade 0.3s ease; }
.bai-msg-user { flex-direction: row-reverse; }
@keyframes msgFade { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }

.bai-msg-avatar {
    width: 26px; height: 26px; border-radius: 8px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.7rem;
}
.bai-msg-ai .bai-msg-avatar { background: rgba(0,212,255,0.1); color: var(--ss-cyan); }
.bai-msg-user .bai-msg-avatar { background: rgba(124,58,237,0.1); color: #a78bfa; }

.bai-msg-bubble {
    max-width: 80%; padding: 10px 14px;
    border-radius: 14px; font-size: 0.82rem; line-height: 1.55;
}
.bai-msg-ai .bai-msg-bubble {
    background: rgba(255,255,255,0.04); color: rgba(255,255,255,0.75);
    border: 1px solid rgba(255,255,255,0.05);
    border-top-left-radius: 4px;
}
.bai-msg-user .bai-msg-bubble {
    background: rgba(0,212,255,0.08); color: rgba(255,255,255,0.85);
    border: 1px solid rgba(0,212,255,0.12);
    border-top-right-radius: 4px;
}

/* Typing indicator */
.bai-typing { display: flex; gap: 4px; padding: 10px 14px; }
.bai-typing-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: var(--ss-cyan); opacity: 0.4;
    animation: typeBounce 1.4s infinite;
}
.bai-typing-dot:nth-child(2) { animation-delay: 0.2s; }
.bai-typing-dot:nth-child(3) { animation-delay: 0.4s; }
@keyframes typeBounce {
    0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
    30% { transform: translateY(-6px); opacity: 1; }
}

/* ── Input ── */
.bai-input-wrap {
    display: flex; gap: 8px; padding: 12px 20px 16px;
    border-top: 1px solid rgba(255,255,255,0.04);
}
.bai-input {
    flex: 1; background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07); border-radius: 12px;
    padding: 10px 16px; font-size: 0.82rem; color: #fff;
    outline: none; transition: border-color 0.2s;
    font-family: inherit;
}
.bai-input::placeholder { color: rgba(255,255,255,0.25); }
.bai-input:focus { border-color: rgba(0,212,255,0.3); }

.bai-send {
    width: 40px; height: 40px; border-radius: 12px; flex-shrink: 0;
    background: linear-gradient(135deg, var(--ss-cyan), var(--ss-blue));
    border: none; color: #fff; font-size: 0.82rem;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;
}
.bai-send:hover { transform: scale(1.05); box-shadow: 0 4px 14px rgba(0,212,255,0.3); }
.bai-send:disabled { opacity: 0.4; cursor: not-allowed; transform: none; box-shadow: none; }

/* ── Responsive ── */
@media (max-width: 576px) {
    .bai-modal { max-height: 95vh; border-radius: 16px; }
    .bai-info { max-height: 240px; }
    .bai-book-row { flex-direction: column; align-items: center; text-align: center; }
    .bai-pills { justify-content: center; }
}
</style>

<script>
window.BookAI = {
    overlay: null,
    bookId: null,
    bookData: null,
    chatHistory: [],
    sending: false,
    csrfToken: '{{ csrf_token() }}',
    urls: {
        info: '{{ url("/api/book-ai/info") }}',
        chat: '{{ url("/api/book-ai/chat") }}',
        history: '{{ url("/api/book-ai/history") }}',
    },

    init() {
        this.overlay = document.getElementById('bookAiOverlay');
    },

    open(bookId, bookName, bookAuthor, coverUrl) {
        if (!this.overlay) this.init();
        this.bookId = bookId;
        this.chatHistory = [];
        this.bookData = { name: bookName, author: bookAuthor, cover: coverUrl };

        // Reset states
        document.getElementById('baiSkeleton').style.display = 'block';
        document.getElementById('baiInfoContent').style.display = 'none';
        document.getElementById('baiError').style.display = 'none';

        // Reset chat
        const chat = document.getElementById('baiChat');
        chat.innerHTML = `<div class="bai-msg bai-msg-ai">
            <div class="bai-msg-avatar"><i class="fas fa-robot"></i></div>
            <div class="bai-msg-bubble">Let me fetch info about <strong>${this.escHtml(bookName)}</strong>...</div>
        </div>`;

        // Show modal
        this.overlay.classList.add('open');
        document.body.style.overflow = 'hidden';

        // Fetch book info
        this.fetchInfo();

        // Load history for logged-in users
        this.loadHistory();
    },

    close() {
        if (this.overlay) {
            this.overlay.classList.remove('open');
            document.body.style.overflow = '';
        }
    },

    async fetchInfo() {
        try {
            const res = await fetch(this.urls.info, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ book_id: this.bookId }),
            });

            if (!res.ok) throw new Error('API error');

            const data = await res.json();
            if (data.error) throw new Error(data.error);

            this.populateInfo(data);
        } catch (err) {
            console.error('BookAI info error:', err);
            document.getElementById('baiSkeleton').style.display = 'none';
            document.getElementById('baiError').style.display = 'block';
        }
    },

    populateInfo(data) {
        document.getElementById('baiCover').src = data.cover || this.bookData.cover;
        document.getElementById('baiCover').alt = data.title;
        document.getElementById('baiTitle').textContent = data.title || this.bookData.name;
        document.getElementById('baiAuthor').textContent = 'by ' + (data.author || this.bookData.author);
        document.getElementById('baiPublisher').textContent = data.publisher ? `Published by ${data.publisher}` : '';

        // Pills
        const pills = [];
        if (data.genre) pills.push(data.genre);
        if (data.year) pills.push(data.year);
        if (data.pages) pills.push(data.pages + ' pages');
        document.getElementById('baiPills').innerHTML = pills.map(p =>
            `<span class="bai-pill">${this.escHtml(String(p))}</span>`
        ).join('');

        document.getElementById('baiDescription').textContent = data.description || '';
        document.getElementById('baiSummary').textContent = data.summary || '';

        document.getElementById('baiSkeleton').style.display = 'none';
        document.getElementById('baiInfoContent').style.display = 'block';

        // Update initial chat message
        const chat = document.getElementById('baiChat');
        chat.innerHTML = `<div class="bai-msg bai-msg-ai">
            <div class="bai-msg-avatar"><i class="fas fa-robot"></i></div>
            <div class="bai-msg-bubble">I've loaded info about <strong>${this.escHtml(data.title || this.bookData.name)}</strong>. Ask me anything about it.</div>
        </div>`;
    },

    retryInfo() {
        document.getElementById('baiError').style.display = 'none';
        document.getElementById('baiSkeleton').style.display = 'block';
        this.fetchInfo();
    },

    async loadHistory() {
        try {
            const res = await fetch(this.urls.history, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ book_id: this.bookId }),
            });
            const data = await res.json();
            if (data.history && data.history.length > 0) {
                const chat = document.getElementById('baiChat');
                data.history.forEach(msg => {
                    this.chatHistory.push({ role: msg.role, text: msg.message });
                    this.appendMessage(msg.role === 'user' ? 'user' : 'ai', msg.message, false);
                });
                chat.scrollTop = chat.scrollHeight;
            }
        } catch (e) {
            // silently fail for guests
        }
    },

    async send() {
        if (this.sending) return;
        const input = document.getElementById('baiInput');
        const question = input.value.trim();
        if (!question) return;

        input.value = '';
        this.sending = true;
        document.getElementById('baiSend').disabled = true;

        // Add user message
        this.appendMessage('user', question);
        this.chatHistory.push({ role: 'user', text: question });

        // Show typing indicator
        const typingEl = this.showTyping();

        try {
            const res = await fetch(this.urls.chat, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    book_id: this.bookId,
                    question: question,
                    history: this.chatHistory.slice(0, -1), // exclude current question
                }),
            });

            typingEl.remove();

            if (!res.ok) throw new Error('Chat API error');

            const data = await res.json();
            if (data.error) throw new Error(data.error);

            this.appendMessage('ai', data.reply);
            this.chatHistory.push({ role: 'model', text: data.reply });
        } catch (err) {
            typingEl.remove();
            this.appendMessage('ai', "Sorry, I'm having trouble connecting right now. Please try again. 🔄");
        }

        this.sending = false;
        document.getElementById('baiSend').disabled = false;
        input.focus();
    },

    appendMessage(type, text, animate = true) {
        const chat = document.getElementById('baiChat');
        const div = document.createElement('div');
        div.className = `bai-msg bai-msg-${type}`;
        if (!animate) div.style.animation = 'none';
        div.innerHTML = `
            <div class="bai-msg-avatar"><i class="fas fa-${type === 'ai' ? 'robot' : 'user'}"></i></div>
            <div class="bai-msg-bubble">${this.escHtml(text)}</div>
        `;
        chat.appendChild(div);
        chat.scrollTop = chat.scrollHeight;
    },

    showTyping() {
        const chat = document.getElementById('baiChat');
        const div = document.createElement('div');
        div.className = 'bai-msg bai-msg-ai';
        div.innerHTML = `
            <div class="bai-msg-avatar"><i class="fas fa-robot"></i></div>
            <div class="bai-msg-bubble bai-typing">
                <span class="bai-typing-dot"></span>
                <span class="bai-typing-dot"></span>
                <span class="bai-typing-dot"></span>
            </div>
        `;
        chat.appendChild(div);
        chat.scrollTop = chat.scrollHeight;
        return div;
    },

    async clearChat() {
        if (!confirm('Clear chat history for this book?')) return;

        const chat = document.getElementById('baiChat');
        chat.innerHTML = `<div class="bai-msg bai-msg-ai">
            <div class="bai-msg-avatar"><i class="fas fa-robot"></i></div>
            <div class="bai-msg-bubble">Chat cleared. Ask me anything about this book.</div>
        </div>`;
        this.chatHistory = [];

        try {
            await fetch(this.urls.history, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ book_id: this.bookId }),
            });
        } catch (e) { /* guest users */ }
    },

    escHtml(str) {
        const d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }
};
</script>
