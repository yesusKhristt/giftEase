<?php
class M_caller
{
    public function QUICK_INDEX(): array
    {
        // Return value: array of method names ranked from most commonly used SQL patterns to least common.
        return [
            'WHERE_AND_OR_FILTER',
            'ORDER_BY_LIMIT',
            'COUNT_ROWS',
            'LIKE_SEARCH',
            'IN_LIST_FILTER',
            'IS_NULL_CHECK',
            'INNERJOIN',
            'LEFTJOIN',
            'GROUPBY_HAVING',
            'DISTINCT_VALUES',
            'BETWEEN_DATE_RANGE',
            'DATE_SUB_RECENT',
            'PAGINATION_LIMIT_OFFSET',
            'SUBQUERY_IN',
            'INSERT_ROW',
            'UPDATE_WITH_JOIN',
            'DELETE_WITH_WHERE',
            'EXISTS_FILTER',
            'COALESCE_DEFAULT_VALUE',
            'CASE_WHEN_LABEL',
            'UNION_ALL_REPORT',
            'UPSERT_MYSQL',
            'INSERT_SELECT_COPY',
            'ANTI_JOIN_LEFT',
            'TRANSACTION_BLOCK',
            'SELF_JOIN_HIERARCHY',
            'CTE_AND_WINDOW',
            'WINDOW_RUNNING_TOTAL',
            'TEMP_TABLE_SESSION',
        ];
    }

    public function WHERE_AND_OR_FILTER(): string
    {
        // Filters users using combined conditions for role, active state, and verification status.
        // Keyword note: WHERE keeps only rows that satisfy the boolean condition, with AND and OR controlling logic.

        $sql = <<<'SQL'
                    SELECT
                        u.user_id,
                        u.full_name,
                        u.role,
                        u.is_active
                    FROM users u
                    WHERE u.role = 'alumni'
                      AND u.is_active = 1
                      AND (u.email_verified = 1 OR u.phone_verified = 1);
                    SQL;

        // Return value: SQL string; query result includes active alumni users with at least one verified contact channel.
        return $sql;
    }

    public function ORDER_BY_LIMIT(): string
    {
        // Shows the latest ten posts based on creation time.
        // Keyword note: ORDER BY sorts rows, and LIMIT restricts how many rows are returned.

        $sql = <<<'SQL'
                    SELECT
                        p.post_id,
                        p.user_id,
                        p.created_at
                    FROM posts p
                    ORDER BY p.created_at DESC
                    LIMIT 10;
                    SQL;

        // Return value: SQL string; query result contains at most 10 most recent post rows.
        return $sql;
    }

    public function COUNT_ROWS(): string
    {
        // Counts how many users are currently active.
        // Keyword note: COUNT(*) returns the number of rows that pass the filter condition.

        $sql = <<<'SQL'
                    SELECT
                        COUNT(*) AS TotalActiveUsers
                    FROM users u
                    WHERE u.is_active = 1;
                    SQL;

        // Return value: SQL string; query result is one row with the active-user count.
        return $sql;
    }

    public function LIKE_SEARCH(): string
    {
        // Finds users whose name contains the text "john" anywhere in the value.
        // Keyword note: LIKE matches text patterns, and % acts as a wildcard for any character sequence.

        $sql = <<<'SQL'
                    SELECT
                        u.user_id,
                        u.full_name,
                        u.email
                    FROM users u
                    WHERE u.full_name LIKE '%john%';
                    SQL;

        // Return value: SQL string; query result includes users whose full_name matches the pattern.
        return $sql;
    }

    public function IN_LIST_FILTER(): string
    {
        // Returns events that are currently in one of the selected statuses.
        // Keyword note: IN compares a value against a fixed list of allowed values.

        $sql = <<<'SQL'
                    SELECT
                        e.event_id,
                        e.title,
                        e.status
                    FROM events e
                    WHERE e.status IN ('draft', 'published', 'cancelled');
                    SQL;

        // Return value: SQL string; query result contains only events with a status present in the IN list.
        return $sql;
    }

    public function IS_NULL_CHECK(): string
    {
        // Finds users who have not set a profile image yet.
        // Keyword note: IS NULL checks missing values; comparing with = NULL does not work as expected.

        $sql = <<<'SQL'
                    SELECT
                        u.user_id,
                        u.full_name,
                        u.email
                    FROM users u
                    WHERE u.profile_image IS NULL;
                    SQL;

        // Return value: SQL string; query result includes users where profile_image has no value.
        return $sql;
    }

    public function INNERJOIN(): string
    {
        // Returns only students who have an active enrollment record.
        // Keyword note: INNER JOIN returns rows only when both joined tables match the join condition.

        $sql = <<<'SQL'
                    SELECT
                    	s.student_id,
                    	s.full_name,
                    	e.course_code,
                    	e.enrolled_at
                    FROM students s
                    INNER JOIN enrollments e ON e.student_id = s.student_id
                    WHERE e.status = 'active';
                    SQL;

        // Return value: SQL string; query result includes only students with at least one active enrollment row.
        return $sql;
    }

    public function LEFTJOIN(): string
    {
        // Keeps every customer in the result and attaches only matching 2024 orders.
        // If a customer has no order, the order fields are NULL and totals fall back to 0.
        // Keyword note: LEFT JOIN keeps all rows from the left table and only matching rows from the right table.

        $sql = <<<'SQL'
                    SELECT
                    	c.CustomerName,
                    	COUNT(o.OrderID) AS NumberOfOrders,
                    	COALESCE(SUM(o.OrderTotal), 0) AS TotalSpent
                    FROM
                    	Customers c
                    LEFT JOIN
                    	Orders o ON c.CustomerID = o.CustomerID
                    	AND o.OrderYear = 2024
                    GROUP BY
                    	c.CustomerID,
                    	c.CustomerName;
                    SQL;

        // Return value: SQL string; query result is one row per customer with order count and total spent for 2024.
        return $sql;
    }

    public function GROUPBY_HAVING(): string
    {
        // Groups active products by category, calculates count and average price,
        // then keeps only categories that have at least five active products.
        // Keyword note: GROUP BY builds aggregates per group, and HAVING filters those grouped results.

        $sql = <<<'SQL'
                    SELECT
                    	p.category,
                    	COUNT(*) AS ProductCount,
                    	ROUND(AVG(p.price), 2) AS AvgPrice
                    FROM products p
                    WHERE p.is_active = 1
                    GROUP BY p.category
                    HAVING COUNT(*) >= 5;
                    SQL;

        // Return value: SQL string; query result shows active-product category aggregates with minimum five records.
        return $sql;
    }

    public function DISTINCT_VALUES(): string
    {
        // Returns a unique list of non-null degree programs.
        // Keyword note: DISTINCT removes duplicate values from the selected columns.

        $sql = <<<'SQL'
                    SELECT DISTINCT
                        ap.degree_program
                    FROM alumni_profiles ap
                    WHERE ap.degree_program IS NOT NULL
                    ORDER BY ap.degree_program ASC;
                    SQL;

        // Return value: SQL string; query result is one row per unique degree program.
        return $sql;
    }

    public function BETWEEN_DATE_RANGE(): string
    {
        // Returns events scheduled inside a fixed calendar range.
        // Keyword note: BETWEEN checks whether a value falls within an inclusive start and end bound.

        $sql = <<<'SQL'
                    SELECT
                        e.event_id,
                        e.title,
                        e.event_date
                    FROM events e
                    WHERE e.event_date BETWEEN '2026-01-01' AND '2026-12-31';
                    SQL;

        // Return value: SQL string; query result contains events dated within the inclusive range.
        return $sql;
    }

    public function DATE_SUB_RECENT(): string
    {
        // Returns posts created in the last seven days.
        // Keyword note: DATE_SUB subtracts a time interval from a date or datetime value.

        $sql = <<<'SQL'
                    SELECT
                        p.post_id,
                        p.user_id,
                        p.created_at
                    FROM posts p
                    WHERE p.created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
                    ORDER BY p.created_at DESC;
                    SQL;

        // Return value: SQL string; query result contains only posts from the most recent seven-day window.
        return $sql;
    }

    public function PAGINATION_LIMIT_OFFSET(): string
    {
        // Returns one page of posts sorted by newest first.
        // Keyword note: LIMIT sets page size, and OFFSET skips earlier rows before returning the page.

        $sql = <<<'SQL'
                    SELECT
                        p.post_id,
                        p.user_id,
                        p.content,
                        p.created_at
                    FROM posts p
                    ORDER BY p.created_at DESC
                    LIMIT 20 OFFSET 40;
                    SQL;

        // Return value: SQL string; query result returns rows 41 to 60 from the ordered post list.
        return $sql;
    }

    public function SUBQUERY_IN(): string
    {
        // Fetches users whose user_id appears in orders placed since 2026-01-01.
        // Keyword note: IN checks whether a value exists in a list or subquery result set.

        $sql = <<<'SQL'
                    SELECT
                    	u.user_id,
                    	u.full_name,
                    	u.email
                    FROM users u
                    WHERE u.user_id IN (
                    	SELECT DISTINCT o.user_id
                    	FROM orders o
                    	WHERE o.created_at >= '2026-01-01'
                    );
                    SQL;

        // Return value: SQL string; query result returns users who placed orders on or after 2026-01-01.
        return $sql;
    }

    public function INSERT_ROW(): string
    {
        // Adds one announcement row with title, body, author id, and current timestamp.
        // Keyword note: INSERT INTO creates a new row in the target table.

        $sql = <<<'SQL'
                INSERT INTO announcements (
                	title,
                	body,
                	posted_by,
                	posted_at
                ) VALUES (
                	'Welcome Batch 2026',
                	'Orientation details are now available.',
                	1,
                	NOW()
                );
                SQL;

        // Return value: SQL string; execution result inserts one announcement row into announcements.
        return $sql;
    }

    public function UPDATE_WITH_JOIN(): string
    {
        // Fills missing user locations using the matched city from alumni_profiles.
        // Keyword note: UPDATE modifies existing rows, and JOIN lets the update use data from related tables.

        $sql = <<<'SQL'
                    UPDATE users u
                    INNER JOIN alumni_profiles ap ON ap.user_id = u.user_id
                    SET u.location = ap.current_city
                    WHERE u.location IS NULL;
                    SQL;

        // Return value: SQL string; execution result updates null user locations from matched alumni profile city values.
        return $sql;
    }

    public function DELETE_WITH_WHERE(): string
    {
        // Removes notifications that are already read and older than 90 days.
        // Keyword note: DELETE removes rows, and WHERE limits which rows are deleted.

        $sql = <<<'SQL'
                    DELETE FROM notifications
                    WHERE is_read = 1
                      AND created_at < DATE_SUB(NOW(), INTERVAL 90 DAY);
                    SQL;

        // Return value: SQL string; execution result deletes read notifications older than 90 days.
        return $sql;
    }

    public function EXISTS_FILTER(): string
    {
        // Lists users who have sent at least one message in the last 30 days.
        // EXISTS stops checking after the first match for each user.
        // Keyword note: EXISTS returns true when the subquery finds at least one row.

        $sql = <<<'SQL'
                    SELECT
                    	u.user_id,
                    	u.full_name
                    FROM users u
                    WHERE EXISTS (
                    	SELECT 1
                    	FROM messages m
                    	WHERE m.sender_id = u.user_id
                    	  AND m.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                    );
                    SQL;

        // Return value: SQL string; query result returns users with at least one message in the last 30 days.
        return $sql;
    }

    public function COALESCE_DEFAULT_VALUE(): string
    {
        // Builds a safe display name by falling back from nickname to full name to a hardcoded label.
        // Keyword note: COALESCE returns the first non-null expression from left to right.

        $sql = <<<'SQL'
                    SELECT
                        u.user_id,
                        COALESCE(u.nickname, u.full_name, 'Unknown User') AS display_name,
                        u.email
                    FROM users u;
                    SQL;

        // Return value: SQL string; query result includes each user with a non-null display_name value.
        return $sql;
    }

    public function CASE_WHEN_LABEL(): string
    {
        // Assigns a readable activity band from each user's profile view count.
        // Keyword note: CASE evaluates conditions in order and returns the first matching output.

        $sql = <<<'SQL'
                    SELECT
                        um.user_id,
                        um.profile_views,
                        CASE
                            WHEN um.profile_views >= 1000 THEN 'high'
                            WHEN um.profile_views >= 200 THEN 'medium'
                            ELSE 'low'
                        END AS activity_band
                    FROM user_metrics um;
                    SQL;

        // Return value: SQL string; query result includes each user with a computed activity band.
        return $sql;
    }

    public function UNION_ALL_REPORT(): string
    {
        // Creates a tiny summary report that shows student and alumni totals in one result.
        // Keyword note: UNION ALL appends result sets and keeps duplicates instead of removing them.

        $sql = <<<'SQL'
                    SELECT 'students' AS source, COUNT(*) AS total
                    FROM students
                    UNION ALL
                    SELECT 'alumni' AS source, COUNT(*) AS total
                    FROM alumni;
                    SQL;

        // Return value: SQL string; query result returns two summary rows, one for students and one for alumni.
        return $sql;
    }

    public function UPSERT_MYSQL(): string
    {
        // Inserts settings for user 42 or updates them if that user already has a row.
        // Keyword note: ON DUPLICATE KEY UPDATE turns an insert into an update when a unique key already exists.

        $sql = <<<'SQL'
                    INSERT INTO user_settings (
                    	user_id,
                    	email_notifications,
                    	updated_at
                    ) VALUES (
                    	42,
                    	1,
                    	NOW()
                    )
                    ON DUPLICATE KEY UPDATE
                    	email_notifications = VALUES(email_notifications),
                    	updated_at = VALUES(updated_at);
                    SQL;

        // Return value: SQL string; execution result inserts or updates the user_settings row for user_id 42.
        return $sql;
    }

    public function INSERT_SELECT_COPY(): string
    {
        // Copies inactive alumni users into an archive table in one statement.
        // Keyword note: INSERT INTO ... SELECT inserts rows returned by a query instead of literal VALUES.

        $sql = <<<'SQL'
                    INSERT INTO alumni_archive (
                        user_id,
                        full_name,
                        archived_at
                    )
                    SELECT
                        u.user_id,
                        u.full_name,
                        NOW()
                    FROM users u
                    WHERE u.role = 'alumni'
                      AND u.is_active = 0;
                    SQL;

        // Return value: SQL string; execution result inserts one archive row for each matching inactive alumni user.
        return $sql;
    }

    public function ANTI_JOIN_LEFT(): string
    {
        // Lists customers who do not have a matching order row.
        // Keyword note: LEFT JOIN plus a right-side IS NULL check is a common anti-join pattern.

        $sql = <<<'SQL'
                    SELECT
                        c.CustomerID,
                        c.CustomerName
                    FROM Customers c
                    LEFT JOIN Orders o ON o.CustomerID = c.CustomerID
                    WHERE o.OrderID IS NULL;
                    SQL;

        // Return value: SQL string; query result returns only customers with zero matching orders.
        return $sql;
    }

    public function TRANSACTION_BLOCK(): string
    {
        // Moves funds between two accounts as one atomic operation.
        // If anything fails before COMMIT, the transaction can be rolled back.
        // Keyword note: START TRANSACTION begins a unit of work, and COMMIT saves all changes together.

        $sql = <<<'SQL'
                    START TRANSACTION;

                    UPDATE accounts
                    SET balance = balance - 500
                    WHERE account_id = 1001;

                    UPDATE accounts
                    SET balance = balance + 500
                    WHERE account_id = 1002;

                    COMMIT;
                    SQL;

        // Return value: SQL string; execution result applies a two-step fund transfer in one transaction block.
        return $sql;
    }

    public function SELF_JOIN_HIERARCHY(): string
    {
        // Shows employees together with their manager names from the same table.
        // Keyword note: A self join joins a table to itself using different aliases for each role.

        $sql = <<<'SQL'
                    SELECT
                        e.employee_id,
                        e.employee_name,
                        m.employee_name AS manager_name
                    FROM employees e
                    LEFT JOIN employees m ON e.manager_id = m.employee_id;
                    SQL;

        // Return value: SQL string; query result includes employee rows with manager_name when available.
        return $sql;
    }

    public function CTE_AND_WINDOW(): string
    {
        // Ranks each user's posts from newest to oldest and returns the latest three.
        // Keyword note: WITH defines a temporary named result set, and ROW_NUMBER() OVER ranks rows per partition.

        $sql = <<<'SQL'
                    WITH ranked_posts AS (
                    	SELECT
                    		p.user_id,
                    		p.post_id,
                    		p.created_at,
                    		ROW_NUMBER() OVER (
                    			PARTITION BY p.user_id
                    			ORDER BY p.created_at DESC
                    		) AS rn
                    	FROM posts p
                    )
                    SELECT
                    	user_id,
                    	post_id,
                    	created_at
                    FROM ranked_posts
                    WHERE rn <= 3;
                    SQL;

        // Return value: SQL string; query result returns up to three most recent posts per user.
        return $sql;
    }

    public function WINDOW_RUNNING_TOTAL(): string
    {
        // Calculates a running total of transaction amounts per account over time.
        // Keyword note: SUM(...) OVER computes a window aggregate without collapsing rows like GROUP BY does.

        $sql = <<<'SQL'
                    SELECT
                        t.account_id,
                        t.txn_date,
                        t.amount,
                        SUM(t.amount) OVER (
                            PARTITION BY t.account_id
                            ORDER BY t.txn_date
                            ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW
                        ) AS running_balance
                    FROM account_transactions t;
                    SQL;

        // Return value: SQL string; query result includes each transaction row plus its running balance.
        return $sql;
    }

    public function TEMP_TABLE_SESSION(): string
    {
        // Creates a temporary table that stores recently active users for the current connection.
        // Keyword note: CREATE TEMPORARY TABLE makes a table that exists only for the current SQL session.

        $sql = <<<'SQL'
                    CREATE TEMPORARY TABLE recent_active_users AS
                    SELECT
                        u.user_id,
                        u.full_name,
                        u.last_login
                    FROM users u
                    WHERE u.last_login >= DATE_SUB(NOW(), INTERVAL 30 DAY);
                    SQL;

        // Return value: SQL string; execution result creates a session-scoped table filled with recent active users.
        return $sql;
    }
}
