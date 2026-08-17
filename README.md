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
