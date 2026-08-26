# 🚀 Argon-Santiago 主题

> 基于 Argon 主题深度定制与优化的 WordPress 主题个人分支。

`Argon-Santiago 主题` 是基于 WordPress 已停更的 Argon 主题进行修复、重构、美化、增加功能与现代化升级的增强版本。

---

## 📦 安装与使用

1. 下载本仓库最新发布的压缩包：
   👉 [下载最新 Release](https://github.com/Santiago-hang/Argon-Santiago/releases))
2. 登录 WordPress 管理后台，进入 `外观` -> `主题` -> `添加` -> `上传主题`。
3. 选择下载好的 `.zip` 文件进行安装并启用。
4. 在 `外观` -> `Argon 主题选项` 中根据需求配置相关参数。

---

## 📄 开源许可协议

本项目基于 [GPL V3.0](https://github.com/solstice23/argon-theme/blob/master/LICENSE) 开源协议发布。

### 声明与致敬：
1. **原项目归属**：本主题为 [solstice23/argon-theme](https://github.com/solstice23/argon-theme) 的二次开发/重构分支[cite: 2]。原主题的核心代码架构与设计版权归原作者 [solstice23](https://github.com/solstice23) 所有。
2. **协议继承**：根据 GPL-3.0 协议规定，任何基于本项目进行的修改、分发或二次衍生作品，**必须同样保持 GPL-3.0 协议开源**，且必须保留原作者与本项目的版权致敬信息。
3. **免责声明**：本主题按“原样（AS IS）”提供，不提供任何形式的明示或暗示担保。使用者可免费用于个人博客或商业站点，但需自行承担使用风险。

---
> 💡 *致敬原作者 solstice23 为开源社区贡献了如此优雅的主题框架！*

## 📅 版本更新日志 (Changelog)

### 🚀 [v1.1.1] - 2026-08-24

### ✨ 优化
- **优化**：统一页脚信息条之间的行间距。

---

### 🚀 [v1.1.0] - 2026-08-21

### ✨ 新增
- **新增**：页脚备案信息（ICP 备案号、公网安备号）、建站时间、版权所有者名称 移至后台「Argon 主题选项 → 底部信息条」可配置，并各自带有显示开关。
- **新增**：页脚「显示设备和IP信息」「显示访客统计」独立开关（此前"显示访客统计"被"运行时间"开关误伤而一并隐藏，现已拆分独立）。

### 🐛 修复
<details>
<summary><b>修复</b>：页脚运行时间计时器时区错误。</summary>

- 后台按"北京时间"填写建站时间却被解析为 UTC，导致运行时差少算 8 小时；现已自动按北京时间解析，所有访客显示一致。

</details>
<details>
<summary><b>修复</b>- **修复**：评论 IP 属地丢失。</summary>

- 原查询链路依赖的网易 API 已失效，且备用 ip-api.com 曾被误设为 HTTPS（免费档仅支持 HTTP），导致新评论无法解析 IP 属地；现已移除失效接口、统一使用 ip-api.com（HTTP，中文返回），并回填了历史评论缺失的 IP 属地。

</details>
<details>
<summary><b>修复</b>：IP 属地查询"毒缓存"缺陷（接口短暂故障会导致 IP 属地长期异常）。</summary>

- 原逻辑在查询失败时，仍把 `未知(API错误)` 按 24 小时写入缓存并写入评论 meta，导致接口短暂抽风会把相关 IP "毒"一整天、且旧评论永久不显示。
- 修复后：查询失败仅缓存 5 分钟且不写入数据库；接口恢复后约 5 分钟内自动重试并自愈，评论 meta 也仅在查询成功时写入。

</details>

---

### 🚀 [v1.0.3] - 2026-08-18

### 🐛 修复
- **修复**：将后台管理和文章链接内忘记修改的 “说说”和“shuoshuo”统一修改为“碎语”和“moment”。

---

### 🚀 [v1.0.2] - 2026-08-17

### 🐛 修复

<details>
<summary><b>修复</b>：parsedown.php —— 动态属性弃用（PHP 8.2 起 E_DEPRECATED，PHP 9.0 致命错误）。</summary>

- `class _Parsedown` 声明上方新增一行 `#[AllowDynamicProperties]`。
- 原因：该类未声明属性，但代码中直接给 `$this->DefinitionData`、`$this->breaksEnabled`、`$this->markupEscaped`、`$this->urlsLinked`、`$this->safeMode`、`$this->strictMode` 赋值，属动态属性写法。

</details>

<details>
<summary><b>修复</b>：隐式 nullable 参数 → 显式 <code>?</code> 类型声明（共 7 处，PHP 8.4 起 E_DEPRECATED）。</summary>

| 文件 | 函数 | 修改前 | 修改后 |
|---|---|---|---|
| parsedown.php | `blockCode()` | `$Block = null` | `?array $Block = null` |
| parsedown.php | `blockList()` | `array $CurrentBlock = null` | `?array $CurrentBlock = null` |
| parsedown.php | `blockSetextHeader()` | `array $Block = null` | `?array $Block = null` |
| parsedown.php | `blockTable()` | `array $Block = null` | `?array $Block = null` |
| functions.php | `argon_get_visitor_ua_display()` | `$userAgent = null` | `?string $userAgent = null` |
| functions.php | `get_avatar_by_qqnumber()` | `$comment_or_email = null` | `mixed $comment_or_email = null` |
| useragent-parser.php | `argon_parse_user_agent()` | `$u_agent = null` | `?string $u_agent = null` |

说明：`get_avatar_by_qqnumber` 的第二参数实际会收到对象/数字/字符串多种类型，故用 `mixed` 而非 `?string`；其余参数调用方只传字符串/数组或 null，类型安全。

</details>

<details>
<summary><b>修复</b>：functions.php —— 删除过时的 WordPress 版本检查。</summary>

- 删除了 `version_compare($GLOBALS['wp_version'], '4.4-alpha', '<')` 的检查及其输出（WP 4.4 为 2015 年版本，当前已形同虚设的死代码）。

</details>

---

### 🚀 [v1.0.1] - 2026-08-11

#### 🐛 修复
- **修复**：修复鼠标悬停在链接内部的图片/图标上时没有任何显示效果的问题。

---

### 🚀 [v1.0.0] - 2026-08-11 (基线版本)
- **首次重构发布**：完成了从原版 Argon 到 `Argon-Santiago` 的完整适配与优化。
- 详细变动清单与完整对比报告，请参阅：[v1.0.0 Release Notes](../../releases/tag/v1.0.0) 。

> 💡 *后续版本演进将基于 `v1.0.0` 进行增量记录，详见 [Releases](../../releases) 页面。*
